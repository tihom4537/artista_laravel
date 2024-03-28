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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_no'); // Change data type to bigInteger
            $table->string('house_no_building');
            $table->string('city');
            $table->string('state');
            $table->string('pin');
            $table->string('profile_photo')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            // $table->string('profile_photo')->nullable();        
            // You might also consider adding a foreign key column for user_id if this table is related to users
            $table->timestamps();
        });
        
        // Schema::create('user_informations', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('first_name');
        //     $table->string('last_name');
        //     $table->
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
