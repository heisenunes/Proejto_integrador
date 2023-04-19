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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('topics');
            $table->unsignedBigInteger('order_id');
            $table->longText('content');
            $table->integer('correct_answers')->default(0);
            $table->integer('incorrect_answers')->default(0);
            $table->boolean('active')->default('True');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question');
    }
};
