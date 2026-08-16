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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('previous_price', 10, 2)->nullable();
            $table->integer('discount_percent')->default(0);
            $table->integer('stock')->default(100);
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video_link')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_bestseller')->default(0);
            $table->boolean('is_hot')->default(0);
            $table->boolean('is_new')->default(1);
            $table->boolean('status')->default(1);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
