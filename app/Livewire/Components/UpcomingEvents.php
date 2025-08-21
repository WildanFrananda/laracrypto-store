<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Repositories\Contracts\PromotionRepositoryInterface;
use Livewire\Component;

class UpcomingEvents extends Component {
    public function render(PromotionRepositoryInterface $promotionRepository) {
        $promotions = $promotionRepository->getActivePromotions(3);

        return view('livewire.components.upcoming-events', [
            'promotions' => $promotions,
        ]);
    }
}
