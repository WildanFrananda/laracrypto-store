<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepositoryInterface;
use Livewire\Component;

class UpcomingEvents extends Component {
    public bool $showModal = false;

    public ?Promotion $selectedPromotion = null;

    public function showDetails(int $promotionId): void {
        $this->selectedPromotion = Promotion::findOrFail($promotionId);
        $this->showModal = true;
    }

    public function closeModal(): void {
        $this->showModal = false;
        $this->selectedPromotion = null;
    }

    public function render(PromotionRepositoryInterface $promotionRepository) {
        $promotions = $promotionRepository->getActivePromotions(3);

        return view('livewire.components.upcoming-events', [
            'promotions' => $promotions,
        ]);
    }
}
