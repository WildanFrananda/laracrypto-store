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
        Schema::table('promotions', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->date('event_date')->nullable()->after('subtitle');
            $table->text('details')->nullable()->after('link_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('promotions', function (Blueprint $table) {
            //
        });
    }
};
