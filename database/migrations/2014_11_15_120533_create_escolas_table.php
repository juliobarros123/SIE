<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*escolas*/
        Schema::create('escolas', function (Blueprint $table) {
            $table->id();
            $table->string('vc_escola', 255);
            $table->string('vc_logo', 255);
            $table->string('vc_num_ide', 255);
            $table->string('vc_localizacao', 255);
            $table->string('it_id_provincia', 255);
            $table->string('it_id_minicipio', 255);
            $table->string('vc_director', 255);
            $table->string('vc_email', 255);
            $table->string('vc_senha', 255);
            $table->unsignedBigInteger('it_id_utilizador');
            $table->foreign('it_id_utilizador')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->date('dt_data_registro');
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
        Schema::dropIfExists('escolas');
    }
}
