<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostaPerguntaQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta_pergunta_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_afirmacao_pergunta_quizzes')->constrained('afirmacao_pergunta_quizzes')->onDelete('CASCADE')->onUpgrade('CASCADE');
            
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
        Schema::dropIfExists('resposta_pergunta_quizzes');
    }
}
