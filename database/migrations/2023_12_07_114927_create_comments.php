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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('comment');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_post')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('id_reply')->nullable(); // Добавляем parent_id
            $table->foreign('id_reply')->references('id')->on('comments')->onDelete('cascade'); // Создаем внешний ключ для parent_id
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
        Schema::dropIfExists('comments');
    }
};
