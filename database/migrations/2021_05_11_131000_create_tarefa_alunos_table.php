<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefaAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefa_alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_utilizador');
            $table->foreign('it_id_utilizador')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->unsignedBigInteger('it_id_tarefa');
            $table->foreign('it_id_tarefa')->references('id')->on('tarefas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->Integer('it_estado')->enum('0','1')->default('1');
            $table->timestamps();
        });
    }//it_id_utilizador,it_id_tarefa,it_estado

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefa_alunos');
    }
}
