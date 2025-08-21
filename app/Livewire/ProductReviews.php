<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviews extends Component {
    use WithPagination;

    public Product $product;

    public int $rating = 5;

    public ?string $comment = null;

    public function submitReview(ReviewService $reviewService): void {
        if (!Auth::check()) {
            $this->redirect(route('login'));

            return;
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $reviewService->create(
            user: Auth::user(),
            product: $this->product,
            rating: $this->rating,
            comment: $this->comment
        );

        $this->reset(['rating', 'comment']);
        session()->flash('review_success', 'Thanks for your review!');
    }

    public function render(ReviewRepositoryInterface $reviewRepository) {
        $reviews = $reviewRepository->getForProduct($this->product);

        return view('livewire.product-reviews', [
            'reviews' => $reviews,
        ]);
    }
}
