<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\SoftDeletes;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->double('price');
            $table->bigInteger('brand_id');
            $table->double('discount_amount')->nullable();
            $table->tinyInteger('discount_type')->default(2);
            $table->string('meta_keyword')->nullable();
            $table->string('meta_content')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('short_description')->nullable();
            $table->bigInteger('category_id');
            $table->softDeletes();

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
