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
        Schema::table('water_points', function (Blueprint $table) {
            $table->string('recommend_depth')->nullable()->after('recommend_longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_points', function (Blueprint $table) {
            $table->dropColumn('recommend_depth');
        });
    }
};
