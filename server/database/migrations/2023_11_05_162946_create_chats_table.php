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
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('aktor_id');
            $table->uuid('room_id');
            $table->uuid('parent_id')->nullable();
            $table->uuid('topmost_parent_id')->nullable();
            $table->integer('children_count')->default(0);
            $table->string('verb');
            $table->string('type');
            $table->text('message');
            $table->timestamps();

            $table->foreign('aktor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
