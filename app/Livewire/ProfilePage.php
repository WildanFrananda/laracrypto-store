<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProfilePage extends Component {
    use WithPagination;

    public string $activeTab = 'orders';

    public User $user;

    public function mount(): void {
        $this->user = Auth::user();
    }

    public function setActiveTab(string $tabName): void {
        $this->activeTab = $tabName;
    }

    public function render(OrderRepositoryInterface $orderRepository) {
        $orders = $this->activeTab === 'orders'
            ? $orderRepository->getForUser(Auth::user())
            : collect();

        return view('livewire.profile-page', [
            'orders' => $orders,
        ])->layout('layouts.app');
    }
}
