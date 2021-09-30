<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_anterior',11)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('propietario_id')->nullable();
            $table->foreign('propietario_id')->references('id')->on('users');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->date('fecha_transferencia')->nullable();
            $table->string('estado',50)->nullable();
            $table->string('pedigree_exportacion',50)->nullable();
            $table->date('fecha_exportacion')->nullable();
            $table->string('pais_destino')->nullable();
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
        Schema::dropIfExists('transferencias');
    }
}
