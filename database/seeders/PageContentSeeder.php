<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        PageContent::updateOrCreate(
            ['page_slug' => 'about-us'],
            [
                'narrative' => 'Tulis cerita brand Anda di sini.',
                'total_orders' => 100,
                'active_customers' => 200,
                'store_branches' => 1,
            ]
        );
    }
}
