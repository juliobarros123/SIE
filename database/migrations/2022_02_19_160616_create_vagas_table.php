<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->string('capa')->nullable();
            $table->string('remuneracao');
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->string('funcao');
            $table->date('datalimite');
            $table->text('caminho_discricao');
            $table->text('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
