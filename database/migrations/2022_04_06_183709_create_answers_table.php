<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions');
            $table->string('content');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('correct_answer_id')->nullable()->constrained('answers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->removeColumn('correct_answer_id');
        });
        Schema::dropIfExists('answers');
    }
};
