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
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('village_name');
            $table->longText('history')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('address')->nullable();
            $table->decimal('area_size', 10, 2)->nullable();
            $table->unsignedInteger('population')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_alt')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('cover_image_alt')->nullable();
            $table->text('map_embed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_profiles');
    }
};
