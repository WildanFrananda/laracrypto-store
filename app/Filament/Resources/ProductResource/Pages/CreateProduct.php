<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends CreateRecord {
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void {
        $imagesWithColors = $this->data['images_with_colors'] ?? [];

        Log::info('Creating product images', ['images_count' => count($imagesWithColors)]);

        foreach ($imagesWithColors as $index => $item) {
            try {
                if (empty($item['image_path']) || empty($item['color_id'])) {
                    Log::warning('Skipping empty image or color', ['index' => $index, 'item' => $item]);

                    continue;
                }

                // Handle file path - Filament FileUpload returns array with UUID keys
                $imagePath = null;
                if (is_array($item['image_path'])) {
                    // Get the first value from the associative array
                    $imagePath = reset($item['image_path']);
                } else {
                    $imagePath = $item['image_path'];
                }

                if (!$imagePath) {
                    Log::warning('No image path found', ['index' => $index, 'item' => $item]);

                    continue;
                }

                // Build full path to the uploaded file
                $fullPath = Storage::disk('public')->path($imagePath);

                if (!file_exists($fullPath)) {
                    Log::error('Image file not found', ['path' => $fullPath]);

                    continue;
                }

                // Add to media collection with color metadata
                $media = $this->record->addMedia($fullPath)
                    ->withCustomProperties([
                        'color_id' => (int) $item['color_id'],
                    ])
                    ->toMediaCollection('products');

                Log::info('Image added to media collection', [
                    'media_id' => $media->id,
                    'color_id' => $item['color_id'],
                    'original_path' => $imagePath,
                ]);

            } catch (\Exception $e) {
                Log::error('Error processing image', [
                    'index' => $index,
                    'error' => $e->getMessage(),
                    'item' => $item,
                ]);
            }
        }
    }
}
