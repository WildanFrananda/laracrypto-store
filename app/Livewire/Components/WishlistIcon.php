<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class WishlistIcon extends Component {
    public int $wishlistCount = 0;

    public function mount(WishlistService $wishlistService): void {
        $this->updateCount($wishlistService);
    }

    #[On('wishlist-updated')]
    public function updateCount(WishlistService $wishlistService): void {
        if (Auth::check()) {
            $this->wishlistCount = $wishlistService->count(Auth::user());
        }
    }

    public function render() {
        return view('livewire.components.wishlist-icon');
    }
}
