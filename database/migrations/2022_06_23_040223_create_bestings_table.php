<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('categoria_pista_id')->nullable();
            $table->foreign('categoria_pista_id')->references('id')->on('categorias_pistas');
            $table->unsignedBigInteger('ejemplar_evento_id')->nullable();
            $table->foreign('ejemplar_evento_id')->references('id')->on('ejemplares_eventos');
            $table->unsignedBigInteger('raza_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->unsignedBigInteger('evento_id')->nullable();
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('ganador_id')->nullable();
            $table->foreign('ganador_id')->references('id')->on('ganadores');
            $table->string('numero_prefijo',5)->nullable();
            $table->string('lugar',5)->nullable();
            $table->string('tipo',50)->nullable();
            $table->string('mejor_grupo',5)->nullable();
            $table->string('recerva_grupo',5)->nullable();

            $table->string('lugar_finalista',5)->nullable();

            // $table->string('mejor_ejemplar',5)->nullable();
            // $table->string('segundo_ejemplar',5)->nullable();
            // $table->string('tercer_ejemplar',5)->nullable();
            // $table->string('cuarto_ejemplar',5)->nullable();
            // $table->string('quinto_ejemplar',5)->nullable();
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
        Schema::dropIfExists('besting');
    }
}
