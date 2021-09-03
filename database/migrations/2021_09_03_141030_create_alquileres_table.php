<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlquileresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('criadero_id')->nullable();
            $table->foreign('criadero_id')->references('id')->on('criaderos');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('propietario_original_id')->nullable();
            $table->foreign('propietario_original_id')->references('id')->on('users');
            $table->unsignedBigInteger('propietario_alquilado_id')->nullable();
            $table->foreign('propietario_alquilado_id')->references('id')->on('users');
            $table->string('numero',3)->nullable();
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('alquileres');
    }
}
