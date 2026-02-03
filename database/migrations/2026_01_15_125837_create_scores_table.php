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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('play_id')->constrained()->cascadeOnDelete();
            $table->integer('ones');
            $table->integer('twos');
            $table->integer('threes');
            $table->integer('fours');
            $table->integer('fives');
            $table->integer('sixes');
            $table->integer('three_kind');
            $table->integer('four_kind');
            $table->integer('full_house');
            $table->integer('small_straight');
            $table->integer('large_straight');
            $table->integer('yahtzee');
            $table->integer('chance');
            $table->integer('yahtzee_bonus');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
