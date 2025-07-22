<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCartIcon extends Component {
    public $cartCount = 0;

    public function mount() {
        $this->updateCartCount();
    }

    #[On('cart.updated')]
    public function updateCartCount() {
        $this->cartCount = count(session()->get('cart', []));
    }

    public function render() {
        return view('livewire.shopping-cart-icon');
    }
}
