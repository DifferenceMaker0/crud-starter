<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
      # Create articles table

      1. New Tables
        - `articles`
          - `id` (auto-incrementing primary key)
          - `title` (string, required)
          - `content` (long text, required)
          - `excerpt` (text, optional)
          - `featured_image` (string, optional, stores file path)
          - `images` (JSON, optional, array of image file paths)
          - `published` (boolean, default false)
          - `published_at` (timestamp, optional)
          - `created_at` (timestamp)
          - `updated_at` (timestamp)
      2. Indexes
        - Index on `published` column for filtering
        - Index on `published_at` column for sorting
        - Index on `title` column for searching
    */

    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('images')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index('published');
            $table->index('published_at');
            $table->index('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};