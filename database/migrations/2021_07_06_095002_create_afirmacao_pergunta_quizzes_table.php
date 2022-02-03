<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfirmacaoPerguntaQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afirmacao_pergunta_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao_respostas');
            $table->foreignId('id_pergunta_quizzes')->constrained('pergunta_quizzes')->onDelete('CASCADE')->onUpgrade('CASCADE');
        
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
        Schema::dropIfExists('afirmacao_pergunta_quizzes');
    }
}
