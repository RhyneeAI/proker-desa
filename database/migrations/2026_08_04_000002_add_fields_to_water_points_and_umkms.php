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
            $table->string('debit')->nullable()->after('direction');
            $table->json('documentation_photos')->nullable()->after('debit');
            $table->json('interpretation_photos')->nullable()->after('documentation_photos');
            $table->dropColumn(['documentation_photo', 'interpretation_photo']);
        });

        Schema::table('umkms', function (Blueprint $table) {
            $table->json('documentation_photos')->nullable()->after('photo_alt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_points', function (Blueprint $table) {
            $table->dropColumn(['debit', 'documentation_photos', 'interpretation_photos']);
            $table->string('documentation_photo')->nullable();
            $table->string('interpretation_photo')->nullable();
        });

        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn('documentation_photos');
        });
    }
};
