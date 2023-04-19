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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')/*->unique()*/; /*mudar nome para topic_order */
            $table->string('title')->unique();
            $table->string('brief')->default('');
            $table->boolean('active')->default('True');
            $table->timestamps();
            $table->foreignId('homepage_image_id')->constrained('images');
            $table->foreignId('icon_image_id')->constrained('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
