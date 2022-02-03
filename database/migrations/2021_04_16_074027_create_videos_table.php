<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('vc_descricao');
            $table->string('vc_video');
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')->references('id')->on('materias')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('videos');
    }
}
