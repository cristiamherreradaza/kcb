<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGanadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('calificacion_id')->nullable();
            $table->foreign('calificacion_id')->references('id')->on('calificaciones');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('evento_id')->nullable();
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unsignedBigInteger('ejemplar_evento_id')->nullable();
            $table->foreign('ejemplar_evento_id')->references('id')->on('ejemplares_eventos');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias_pistas');
            $table->unsignedBigInteger('raza_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->string('sexo',10)->nullable();
            $table->string('numero_prefijo',100)->nullable();
            $table->string('calificacion',100)->nullable();
            $table->string('lugar',5)->nullable();
            $table->string('mejor_escogido',10)->nullable();
            $table->string('mejor_macho',10)->nullable();
            $table->string('mejor_hembra',10)->nullable();
            $table->string('mejor_cachorro',10)->nullable();
            $table->string('sexo_opuesto_cachorro',10)->nullable();
            $table->string('mejor_joven',10)->nullable();
            $table->string('sexo_opuesto_joven',10)->nullable();
            $table->string('mejor_raza',10)->nullable();
            $table->string('sexo_opuesto_raza',10)->nullable();
            $table->string('pista',3)->nullable();
            $table->string('estado')->nullable();
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('ganadores');
    }
}
