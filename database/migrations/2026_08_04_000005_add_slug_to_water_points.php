<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('water_points', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        DB::table('water_points')->whereNull('slug')->orderBy('id')->each(function ($row) {
            DB::table('water_points')->where('id', $row->id)->update(['slug' => 'titik-air-'.$row->id]);
        });

        Schema::table('water_points', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_points', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
