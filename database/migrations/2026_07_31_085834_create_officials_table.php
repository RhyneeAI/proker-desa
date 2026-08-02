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
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo')->nullable();
            $table->string('photo_alt')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
