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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->string('role_name');
            $table->string('role_color');
            $table->string('priority');
            $table->boolean('seperate_display');
            $table->boolean('view_channels');
            $table->boolean('view_private_channels');
            $table->boolean('manage_channles');
            $table->boolean('manage_roles');
            $table->boolean('manage_emotes');
            $table->boolean('manage_server');
            $table->boolean('create_invites');
            $table->boolean('kick_members');
            $table->boolean('send_read_messages');
            $table->boolean('create_read_send_public_threads');
            $table->timestamps();
            $table->foreign('server_id')->references('id')->on('servers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
