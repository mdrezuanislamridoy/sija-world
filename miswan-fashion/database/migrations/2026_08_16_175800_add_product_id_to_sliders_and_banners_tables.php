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
        Schema::table('sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('sliders', 'product_id')) {
                $table->foreignId('product_id')->nullable()->after('link')->constrained('products')->nullOnDelete();
            }
            if (!Schema::hasColumn('sliders', 'button_text')) {
                $table->string('button_text')->nullable()->after('sort_order');
            }
        });

        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'product_id')) {
                $table->foreignId('product_id')->nullable()->after('link')->constrained('products')->nullOnDelete();
            }
            if (!Schema::hasColumn('banners', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
            if (!Schema::hasColumn('banners', 'button_text')) {
                $table->string('button_text')->nullable()->after('link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            if (Schema::hasColumn('sliders', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('sliders', 'button_text')) {
                $table->dropColumn('button_text');
            }
        });

        Schema::table('banners', function (Blueprint $table) {
            if (Schema::hasColumn('banners', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('banners', 'subtitle')) {
                $table->dropColumn('subtitle');
            }
            if (Schema::hasColumn('banners', 'button_text')) {
                $table->dropColumn('button_text');
            }
        });
    }
};
