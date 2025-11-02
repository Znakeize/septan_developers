<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_images', function (Blueprint $table) {
            if (!Schema::hasColumn('hero_images', 'page_type')) {
                $table->string('page_type')->unique()->after('id');
            }
            if (!Schema::hasColumn('hero_images', 'images')) {
                $table->json('images')->after('page_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_images', function (Blueprint $table) {
            if (Schema::hasColumn('hero_images', 'page_type')) {
                $table->dropColumn('page_type');
            }
            if (Schema::hasColumn('hero_images', 'images')) {
                $table->dropColumn('images');
            }
        });
    }
};
