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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->bigInteger('type_id');
            $table->bigInteger('color_id');
            $table->bigInteger('material_id');
            $table->bigInteger('size_id');
            $table->bigInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('type_id');
            $table->dropColumn('color_id');
            $table->dropColumn('material_id');
            $table->dropColumn('quantity');
        });
    }
};
