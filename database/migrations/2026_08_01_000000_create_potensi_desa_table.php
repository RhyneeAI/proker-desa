<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('potensi_desa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('lainnya');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potensi_desa');
    }
};
