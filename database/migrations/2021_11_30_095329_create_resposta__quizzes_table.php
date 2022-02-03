<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostaQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta__quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('resposta');
            $table->text('slug');
            $table->unsignedBigInteger('id_questao');
            $table->foreign('id_questao')->references('id')->on('questao__quizzes')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->unsignedBigInteger('estado')->enum('0','1')->default('0');
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
        Schema::dropIfExists('resposta__quizzes');
    }
}
