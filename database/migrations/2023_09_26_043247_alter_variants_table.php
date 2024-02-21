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
        Schema::table('variants', function (Blueprint $table) {
            //
            if (Schema::hasColumn('variants', 'product_id')) {
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('variants', 'variant_id')) {
                $table->dropColumn('variant_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            //
            $table->bigInteger('variant_id');
            $table->bigInteger('product_id');
        });
    }
};
