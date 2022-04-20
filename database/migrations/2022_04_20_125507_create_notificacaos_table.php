<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacaos', function (Blueprint $table) {
            $table->id();
            $table->string('notificacao');
            $table->string('tipo');
            $table->string('url');
            $table->unsignedBigInteger('id_remetente')->nullable();
            $table->foreign('id_remetente')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->unsignedBigInteger('id_destinatario')->nullable();
            $table->foreign('id_destinatario')->references('id')->on('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->text('slug')->nullable();
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
        Schema::dropIfExists('notificacaos');
    }
}
