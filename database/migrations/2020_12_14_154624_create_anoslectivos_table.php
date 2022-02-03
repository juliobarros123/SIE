<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnoslectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anoslectivos', function (Blueprint $table) {
            $table->id();
            $table->year('ya_inicio');
            $table->year('ya_fim');
            $table->unsignedBigInteger('it_estado')->enum('0','1')->default('1');
            $table->unsignedBigInteger('it_ano_lectivo_corrente')->enum('0','1')->default('0');
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
        Schema::dropIfExists('anoslectivos');
    }
}
