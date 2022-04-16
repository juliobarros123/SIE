<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitoVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisito_vagas', function (Blueprint $table) {
            $table->id();
            $table->string('requisito1')->default('0');
            $table->string('requisito2')->default('0');
            $table->string('requisito3')->default('0');
            $table->string('requisito4')->default('0');
            $table->text('slug')->nullable();
            $table->softDeletes();
            $table->foreignId('id_vaga')->constrained('users')->on('vagas')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('requisito_vagas');
    }
}
