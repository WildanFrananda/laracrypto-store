<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Product::create([
            'name' => 'Crypto Dev T-Shirt',
            'description' => 'Kaos nyaman untuk para developer Web3 sejati.',
            'image_url' => 'https://placehold.co/600x400/1d4ed8/ffffff?text=Crypto+T-Shirt',
            'price' => 25.00,
        ]);

        Product::create([
            'name' => 'Blockchain Mug',
            'description' => 'Mulai harimu dengan secangkir kopi dan desentralisasi.',
            'image_url' => 'https://placehold.co/600x400/334155/ffffff?text=Blockchain+Mug',
            'price' => 15.50,
        ]);

        Product::create([
            'name' => '"To The Moon" Cap',
            'description' => 'Topi untuk para HODLer yang optimis.',
            'image_url' => 'https://placehold.co/600x400/16a34a/ffffff?text=HODL+Cap',
            'price' => 19.99,
        ]);
    }
}
