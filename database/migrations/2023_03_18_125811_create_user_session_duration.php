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
        Schema::create('user_session_durations', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('first_request_time');
            $table->integer('last_request_time');
            $table->integer('session_duration')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_session_duration');
    }
};
