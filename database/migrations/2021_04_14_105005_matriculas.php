<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Matriculas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
             $table->foreignId ('it_id_utilizador')->constrained('users')->onDelete('CASCADE')->onUpgrade('CASCADE');
             $table->foreignId ('it_id_escola')->constrained('escolas')->onDelete('CASCADE')->onUpgrade('CASCADE')->nullable();
             $table->foreignId ('it_id_classe')->constrained('classes')->onDelete('CASCADE')->onUpgrade('CASCADE');
             $table->foreignId ('it_id_anolectivo')->constrained('anoslectivos')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('matriculas');
    }
}
