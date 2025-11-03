<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->unique(); // e.g., 'about-us'
            $table->text('narrative')->nullable();
            $table->integer('total_orders')->default(0);
            $table->integer('active_customers')->default(0);
            $table->integer('store_branches')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('page_contents');
    }
};
