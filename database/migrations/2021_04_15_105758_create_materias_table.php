<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
 {
    /**
    * Run the migrations.
    *
    * @return void
    */

    public function up()
 {
        Schema::create( 'materias', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'vc_materia' );
            $table->unsignedBigInteger( 'id_horarios' );
            $table->foreign( 'id_horarios' )->references( 'id' )->on( 'horarios' )->onDelete( 'CASCADE' )->onUpgrade( 'CASCADE' );
            $table->unsignedBigInteger( 'it_id_classeDisciplina' );
            $table->foreign( 'it_id_classeDisciplina' )->references( 'id' )->on( 'classe_disciplinas')->onDelete('CASCADE')->onUpgrade('CASCADE');
            $table->unsignedBigInteger('it_estado')->enum('0','1')->default('1');
            $table->date('dt_data_vizualizar');
            $table->unsignedBigInteger( 'it_id_unidadeMateria' );
            $table->foreign( 'it_id_unidadeMateria' )->references( 'id' )->on( 'unidade_materias')->onDelete('CASCADE')->onUpgrade('CASCADE');
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
        Schema::dropIfExists('materias' );
        }
    }
