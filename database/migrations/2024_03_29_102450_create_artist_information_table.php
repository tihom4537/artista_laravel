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
        Schema::create('artist_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->string('name');
            $table->unsignedInteger('age')->nullable();
            $table->string('phone_number');
            $table->string('address');
            $table->string('skill_category');
            $table->string('skills');
            $table->text('about_yourself')->nullable();
            $table->decimal('price_per_hour', 8, 2);
            $table->string('audio1')->nullable();
            $table->string('audio2')->nullable(); 
            $table->string('video1')->nullable();
            $table->string('video2')->nullable();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4')->nullable();
            $table->text('special_message')->nullable();
            $table->string('profile_photo');
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
        Schema::dropIfExists('artist_information');
    }
};
