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
        Schema::create('wordsets', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
        });

        Schema::table('wordsets',function (Blueprint $table) {
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wordsets');
    }
};
