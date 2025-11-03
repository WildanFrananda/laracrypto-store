<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\PageContent;
use App\Repositories\Contracts\PageContentRepositoryInterface;
use Livewire\Component;

class AboutUsPage extends Component {
    public ?PageContent $content = null;

    public function mount(PageContentRepositoryInterface $pageContentRepository): void {
        $this->content = $pageContentRepository->findBySlug('about-us');
    }

    public function render() {
        return view('livewire.about-us-page')
            ->layout('layouts.app');
    }
}
