<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoUtilizadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_utilizadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_utilizador')->nullable();
            $table->foreign('it_id_utilizador')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE')->nullable();
            $table->unsignedBigInteger('it_id_materia')->nullable();
            $table->foreign('it_id_materia')->references('id')->on('materias')->onDelete('CASCADE')->onUpgrade('CASCADE')->nullable();
            $table->unsignedBigInteger('it_id_tarefa')->nullable();
            $table->foreign('it_id_tarefa')->references('id')->on('tarefas')->onDelete('CASCADE')->onUpgrade('CASCADE')->nullable();
            $table->string('vc_assunto')->nullable();
            $table->string('vc_descricao')->nullable();
            $table->Integer('it_estado')->enum('0','1')->default('1');
            $table->timestamps();
        });//it_id_utilizador,it_id_materia,it_id_tarefa,vc_assunto,vc_descricao,it_estado
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacao_utilizadors');
    }
}
