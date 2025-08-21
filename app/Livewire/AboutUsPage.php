<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Settings\AboutUsSettings;
use Livewire\Component;

class AboutUsPage extends Component {
    public function render(AboutUsSettings $settings) {
        return view('livewire.about-us-page', [
            'settings' => $settings,
        ])->layout('layouts.app');
    }
}
