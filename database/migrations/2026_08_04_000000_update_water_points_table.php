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
            $table->dropColumn(['category', 'status', 'latitude', 'longitude', 'photo', 'photo_alt']);

            $table->decimal('start_latitude', 10, 7)->nullable()->after('address');
            $table->decimal('start_longitude', 10, 7)->nullable()->after('start_latitude');
            $table->decimal('end_latitude', 10, 7)->nullable()->after('start_longitude');
            $table->decimal('end_longitude', 10, 7)->nullable()->after('end_latitude');
            $table->decimal('recommend_latitude', 10, 7)->nullable()->after('end_longitude');
            $table->decimal('recommend_longitude', 10, 7)->nullable()->after('recommend_latitude');
            $table->string('direction')->nullable()->after('recommend_longitude');
            $table->string('documentation_photo')->nullable()->after('direction');
            $table->string('interpretation_photo')->nullable()->after('documentation_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_points', function (Blueprint $table) {
            $table->dropColumn([
                'start_latitude', 'start_longitude',
                'end_latitude', 'end_longitude',
                'recommend_latitude', 'recommend_longitude',
                'direction', 'documentation_photo', 'interpretation_photo',
            ]);

            $table->string('category')->nullable();
            $table->string('status')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('photo')->nullable();
            $table->string('photo_alt')->nullable();
        });
    }
};
