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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->unique();
            $table->string('email')->unique();
            $table->string('display_name')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('banner_pic')->nullable();
            $table->string('password');
            $table->string('status');
            $table->string('activities')->nullable();
            $table->string('about_me')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
