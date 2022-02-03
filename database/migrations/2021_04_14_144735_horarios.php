<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function  (Blueprint $table){
            $table->id();
            $table->foreignId ('it_id_classedisciplina')->constrained('classe_disciplinas');
            $table->string ('vc_hora_inicio');
            $table->string ('vc_hora_fim');
            $table->foreignId ('it_id_dias')->constrained('dias_semanas');
            $table->foreignId ('it_id_anoslectivos')->constrained('anoslectivos');
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
        Schema::dropIfExists('horarios');
    }
}
