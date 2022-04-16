<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('curriculo');
            $table->foreignId('id_canditado')->constrained('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->foreignId('id_vaga')->constrained('users')->on('vagas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->string('estado')->enum('0','1')->default('0');
            $table->text('slug')->nullable();
            $table->string('requisitoCandidato1')->default('0');
            $table->string('requisitoCandidato2')->default('0');
            $table->string('requisitoCandidato3')->default('0');
            $table->string('requisitoCandidato4')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('candidatos');
    }
}
