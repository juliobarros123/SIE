<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalheArquivoVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhe_arquivo_videos', function (Blueprint $table) {
            $table->id();
            $table->string('vc_tipo_de_aquirvo');
            $table->string('vc_tamanho');
            $table->foreignId('id_video')->constrained('videos')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('detalhe_arquivo_videos');
    }
}
