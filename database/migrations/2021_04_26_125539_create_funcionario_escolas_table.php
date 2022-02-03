<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_escolas', function (Blueprint $table) {
            $table->id();

            $table->foreignId ('it_id_utilizador')->constrained('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->foreignId ('it_id_escola')->constrained('escolas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->foreignId ('it_id_classedisciplina')->constrained('classe_disciplinas')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('funcionario_escolas');
    }
}
