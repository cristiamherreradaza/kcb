<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModificacionesEspecificosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificaciones_especificos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->string('campo')->nullable();
            $table->string('dato_anteriror',500)->nullable();
            $table->string('dato_modificado',500)->nullable();
            $table->string('accion')->nullable();
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
        Schema::dropIfExists('modificaciones_especificos');
    }
}
