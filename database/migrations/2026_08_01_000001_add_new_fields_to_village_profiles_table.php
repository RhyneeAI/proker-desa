<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->string('border_north')->nullable();
            $table->string('border_south')->nullable();
            $table->string('border_east')->nullable();
            $table->string('border_west')->nullable();
            $table->string('org_chart_image')->nullable();
            $table->string('bpd_chart_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumnIfExists('border_north');
            $table->dropColumnIfExists('border_south');
            $table->dropColumnIfExists('border_east');
            $table->dropColumnIfExists('border_west');
            $table->dropColumnIfExists('org_chart_image');
            $table->dropColumnIfExists('bpd_chart_image');
        });
    }
};
