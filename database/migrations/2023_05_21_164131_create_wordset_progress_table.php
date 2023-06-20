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
        Schema::create('wordset_progress', function (Blueprint $table) {
            $table->id('id');
            $table->integer('balles');
        });

        Schema::table('wordset_progress',function (Blueprint $table) {
            $table->foreignId('wordset_id')->references('id')->on('wordsets')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wordset_progress');
    }
};
