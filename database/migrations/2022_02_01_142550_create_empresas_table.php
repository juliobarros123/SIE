<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('logotipo');
            $table->string('nome');
            $table->string('email')->unique();
            $table->integer('telefone')->nullable();   
            $table->text('nif')->nullable();  
            $table->text('endereco')->nullable();
            $table->foreignId('propreitario')->constrained('users')->onDelete('CASCADE')->onUpgrade('CASCADE');;
            $table->text('slug')->nullable();
            $table->text('foco')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
