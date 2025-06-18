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
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('overview');
            $table->string('release_date');
            $table->decimal('rating', 2, 1);
            $table->string('runtime');
            $table->boolean('is_movie')->default(true);
            $table->string('thumbnail_url');
            $table->string('bg_url');
            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
