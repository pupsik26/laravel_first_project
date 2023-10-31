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
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название тектса');
            $table->timestamps();
        });

        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->longText('text')->comment('Текст');
            $table->unsignedBigInteger('user_id')->comment('Кто создал');
            $table->unsignedBigInteger('title_id')->comment('Название текста');
            $table->timestamps();

            $table->foreign('user_id', 'fk_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('title_id', 'fk_title_id')
                ->references('id')
                ->on('titles')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('texts');
        Schema::dropIfExists('title');
    }
};
