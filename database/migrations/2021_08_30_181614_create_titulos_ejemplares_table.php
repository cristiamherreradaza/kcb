<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitulosEjemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulos_ejemplares', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_anterior')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('titulo_id')->nullable();
            $table->foreign('titulo_id')->references('id')->on('titulos');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->date('fecha_obtencion')->nullable();
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
        Schema::dropIfExists('titulos_ejemplares');
    }
}
