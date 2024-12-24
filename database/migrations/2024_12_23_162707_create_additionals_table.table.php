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
        Schema::create('additionals', function (Blueprint $table) {
            $table->id();
            $table->text('how_vain')->nullable();
            $table->text('skills')->nullable();
            $table->text('business_about')->nullable();
            $table->text('corporate_job')->nullable();
            $table->text('mission')->nullable();
            $table->text('ideal_audience')->nullable();
            $table->text('dont_work_with')->nullable();
            $table->text('values')->nullable();
            $table->text('tone')->nullable();
            $table->text('looking_for_in_creelo')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('sign')->nullable();
            $table->text('hobbies')->nullable();
            $table->string('favorite_drink')->nullable();
            $table->string('has_children')->nullable();
            $table->string('is_married')->nullable();
            $table->text('favorite_trip')->nullable();
            $table->text('next_trip')->nullable();
            $table->string('favorite_dessert')->nullable();
            $table->string('favorite_food')->nullable();
            $table->text('movie_recommendation')->nullable();
            $table->text('book_recommendation')->nullable();
            $table->text('podcast_recommendation')->nullable();
            $table->text('irreplaceable')->nullable();
            $table->text('achievement')->nullable();
            $table->text('biggest_dream')->nullable();
            $table->text('gift')->nullable();
            $table->text('gift_link')->nullable();
            $table->text('like_to_receive')->nullable();
            $table->text('brings_you_happiness')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_info');
    }
};
