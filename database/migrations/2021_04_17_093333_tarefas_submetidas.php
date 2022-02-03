<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TarefasSubmetidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas_submetidas', function (Blueprint $table) {
            $table->id();
            $table->String('vc_tarefa');
             $table->String('vc_pdf');
             $table->foreignId ('it_id_tarefas')->constrained('tarefas')->onDelete('CASCADE')->onUpgrade('CASCADE');
             $table->unsignedBigInteger('it_id_utilizador');
             $table->foreign('it_id_utilizador')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
             $table->unsignedBigInteger('it_id_matricula')->nullable();
             $table->foreign('it_id_matricula')->references('id')->on('matriculas')->onDelete('CASCADE')->onUpgrade('CASCADE')->nullable();
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
        Schema::dropIfExists('tarefas_submetidas');
    }
}