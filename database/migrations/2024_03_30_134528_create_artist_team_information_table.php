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
        Schema::create('artist_team_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->string('team_name');
            $table->string('phone_number');
            $table->string('alt_phone_number');
            $table->string('address');
            $table->string('skill_category');
            $table->text('about_team')->nullable();
            $table->decimal('price_per_hour', 8, 2);
            $table->string('audio1')->nullable();
            $table->string('audio2')->nullable();
            $table->string('video1')->nullable();
            $table->string('video2')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->text('special_message')->nullable();
            $table->string('profile_photo')->nullable();
            $table->boolean('featured')->default(false);
            $table->foreign('artist_id')
                    ->references('id')
                    ->on('artists')
                    ->onDelete('cascade');
            // $table->string('profile_photo')->nullable();        
            // You might also consider adding a foreign key column for user_id if this table is related to users
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_team_information');
    }
};
