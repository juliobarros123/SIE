<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntaQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pergunta_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao_perguntas');
            $table->time('time')->nullable()->default('10:00:00');
            $table->foreignId('id_materia')->constrained('materias')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->integer('pos');
            $table->unsignedBigInteger('it_estado')->enum('0','1')->default('1');
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
        Schema::dropIfExists('pergunta_quizzes');
    }
}
