<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvlLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avl-logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment('id пользователя');
            $table->integer('section_id')->nullable()->comment('ID раздела');
            $table->string('event')->comment('Событие');
            $table->string('model')->nullable()->comment('Модель');
            $table->integer('model_id')->nullable()->comment('Номер записи');
            $table->json('previous')->nullable()->comment('До сохранения');
            $table->json('following')->nullable()->comment('До сохранения');
            $table->json('headers')->nullable()->comment('Заголовки');
            $table->string('ip', 20)->nullable()->comment('IP пользователя');
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
        Schema::dropIfExists('avl-logs');
    }
}
