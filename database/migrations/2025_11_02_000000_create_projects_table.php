<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location');
            $table->string('year');
            $table->string('type');
            $table->string('category'); // residential, commercial, renovation
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('client_name')->nullable();
            $table->decimal('project_area', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
