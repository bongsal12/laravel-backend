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
        Schema::table('movie', function (Blueprint $table) {
            $table->string('slug')->after('title');
            $table->string('vdo_url')->after('bg_url');
            $table->boolean('is_trending')->default(false)->after('vdo_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('vdo_url');
            $table->dropColumn('is_trending');
        });
    }
};
