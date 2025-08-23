<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeWidget extends Widget {
    protected static string $view = 'filament-panels::widgets.account-widget';

    protected static ?int $sort = -4;

    protected int|string|array $columnSpan = 'full';
}
