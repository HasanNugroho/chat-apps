<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(gen_random_uuid())'))->primary();
            $table->uuid('aktor_id');
            $table->uuid('room_id');
            $table->string('display_name');
            $table->integer('participant_type');
            $table->integer('favorite')->default(0);
            $table->integer('notification_level')->default(0);
            $table->uuid('last_read_message')->nullable();
            $table->uuid('last_mention_message')->nullable();
            $table->timestamps();

            $table->foreign('aktor_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendees');
    }
};
