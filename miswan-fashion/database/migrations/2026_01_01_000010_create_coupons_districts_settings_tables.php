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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(100.00);
            $table->timestamps();
        });

        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->timestamps();
        });

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->default('fixed'); // fixed, percentage
            $table->decimal('value', 10, 2);
            $table->decimal('min_purchase', 10, 2)->default(0.00);
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Miswan Fashion');
            $table->string('site_title')->default('Miswanfashion | Bangladesh’s Leading Fashion Brand');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone')->default('+8801700000000');
            $table->string('email')->default('support@miswanfashion.com');
            $table->string('address')->default('Dhaka, Bangladesh');
            $table->string('currency_symbol')->default('TK');
            $table->decimal('shipping_inside_city', 10, 2)->default(60.00);
            $table->decimal('shipping_outside_city', 10, 2)->default(120.00);
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->text('announcement_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('upazilas');
        Schema::dropIfExists('districts');
    }
};
