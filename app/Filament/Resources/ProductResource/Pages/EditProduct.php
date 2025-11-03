<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EditProduct extends EditRecord {
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array {
        // Load existing media with color associations
        $mediaItems = $this->record->getMedia('products');
        $data['images_with_colors'] = [];

        foreach ($mediaItems as $media) {
            // For existing media, we populate the form with existing data
            $data['images_with_colors'][] = [
                'image_path' => null, // FileUpload will be empty for existing
                'color_id' => $media->getCustomProperty('color_id'),
                'media_uuid' => $media->uuid, // Store UUID for identification
            ];
        }

        Log::info('Form data prepared for editing', [
            'product_id' => $this->record->id,
            'images_count' => count($data['images_with_colors']),
        ]);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model {
        $imagesWithColors = $data['images_with_colors'] ?? [];
        unset($data['images_with_colors']);

        // Update basic product data
        $record->update($data);

        Log::info('Updating product images', [
            'product_id' => $record->id,
            'images_count' => count($imagesWithColors),
        ]);

        $processedMediaUuids = [];

        foreach ($imagesWithColors as $index => $item) {
            try {
                if (empty($item['color_id'])) {
                    Log::warning('Skipping item without color_id', ['index' => $index]);

                    continue;
                }

                // Check if this is an existing media (has media_uuid) or new upload
                if (!empty($item['media_uuid'])) {
                    // This is an existing media item
                    $media = Media::where('uuid', $item['media_uuid'])->first();
                    if ($media) {
                        // Update color association
                        $media->setCustomProperty('color_id', (int) $item['color_id']);
                        $media->save();
                        $processedMediaUuids[] = $media->uuid;

                        Log::info('Updated existing media color association', [
                            'media_id' => $media->id,
                            'color_id' => $item['color_id'],
                        ]);

                        // Check if user uploaded a new image to replace existing one
                        if (!empty($item['image_path'])) {
                            // Delete old media and create new one
                            $oldMediaUuid = $media->uuid;
                            $media->delete();

                            // Process new image upload
                            $imagePath = null;
                            if (is_array($item['image_path'])) {
                                $imagePath = reset($item['image_path']);
                            } else {
                                $imagePath = $item['image_path'];
                            }

                            if ($imagePath) {
                                $fullPath = str_contains($imagePath, 'livewire-tmp')
                                    ? Storage::path($imagePath)
                                    : Storage::disk('public')->path($imagePath);

                                if (file_exists($fullPath)) {
                                    $newMedia = $record->addMedia($fullPath)
                                        ->withCustomProperties(['color_id' => (int) $item['color_id']])
                                        ->toMediaCollection('products');

                                    // Remove old UUID from processed list and add new one
                                    $processedMediaUuids = array_filter($processedMediaUuids, fn ($uuid) => $uuid !== $oldMediaUuid);
                                    $processedMediaUuids[] = $newMedia->uuid;

                                    Log::info('Replaced existing media with new upload', [
                                        'old_media_uuid' => $oldMediaUuid,
                                        'new_media_id' => $newMedia->id,
                                    ]);
                                }
                            }
                        }
                    }
                } elseif (!empty($item['image_path'])) {
                    // This is a completely new upload
                    $imagePath = null;
                    if (is_array($item['image_path'])) {
                        $imagePath = reset($item['image_path']);
                    } else {
                        $imagePath = $item['image_path'];
                    }

                    if (!$imagePath) {
                        continue;
                    }

                    $fullPath = str_contains($imagePath, 'livewire-tmp')
                        ? Storage::path($imagePath)
                        : Storage::disk('public')->path($imagePath);

                    if (!file_exists($fullPath)) {
                        Log::error('New image file not found', ['path' => $fullPath]);

                        continue;
                    }

                    $media = $record->addMedia($fullPath)
                        ->withCustomProperties(['color_id' => (int) $item['color_id']])
                        ->toMediaCollection('products');

                    $processedMediaUuids[] = $media->uuid;

                    Log::info('Added new media to collection', [
                        'media_id' => $media->id,
                        'color_id' => $item['color_id'],
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error processing image update', [
                    'index' => $index,
                    'error' => $e->getMessage(),
                    'item' => $item,
                ]);
            }
        }

        // Remove media that are no longer in the form
        $mediaToDelete = $record->getMedia('products')
            ->whereNotIn('uuid', $processedMediaUuids);

        foreach ($mediaToDelete as $media) {
            Log::info('Deleting unused media', ['media_id' => $media->id]);
            $media->delete();
        }

        return $record;
    }
}
