<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestaoQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questao__quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('questao');
            $table->unsignedBigInteger('id_nivel');
            $table->foreign('id_nivel')->references('id')->on('nivel__quizzes')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categoria__quizzes')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->text('slug');
            $table->unsignedBigInteger('id_classe_disciplina');
            $table->foreign('id_classe_disciplina')->references('id')->on('classe_disciplinas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->time('time')->nullable()->default('10:00:00');
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
        Schema::dropIfExists('questao__quizzes');
    }
}
