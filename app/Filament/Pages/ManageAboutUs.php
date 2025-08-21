<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Settings\AboutUsSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAboutUs extends SettingsPage {
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'About Us';

    protected static ?string $slug = 'settings/about-us';

    protected static string $settings = AboutUsSettings::class;

    public function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Section::make('We Are Section')
                    ->schema([
                        Forms\Components\RichEditor::make('narrative')->required(),
                    ]),

                Forms\Components\Section::make('Statistics')
                    ->schema([
                        Forms\Components\TextInput::make('total_orders')->numeric()->required(),
                        Forms\Components\TextInput::make('active_customers')->numeric()->required(),
                        Forms\Components\TextInput::make('store_branches')->numeric()->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Gallery')
                    ->schema([
                        Forms\Components\Repeater::make('gallery_images')
                            ->schema([
                                Forms\Components\TextInput::make('url')->url()->required(),
                            ])
                            ->addActionLabel('Add Image URL'),
                    ]),
            ]);
    }

    protected function mutateDataBeforeSave(array $data): array {
        $data['total_orders'] = (int) $data['total_orders'];
        $data['active_customers'] = (int) $data['active_customers'];
        $data['store_branches'] = (int) $data['store_branches'];

        return $data;
    }
}
