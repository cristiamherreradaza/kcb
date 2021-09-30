<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo_anterior')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('padre_id')->nullable();
            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable();
            $table->foreign('madre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('criadero_id')->nullable();
            $table->foreign('criadero_id')->references('id')->on('criaderos');
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->unsignedBigInteger('raza_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->string('tipo_pelo')->nullable();
            $table->string('variedad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('camada')->nullable();
            $table->string('lechigada')->nullable();
            $table->string('num_parto_madre')->nullable();
            $table->string('cachorros_encontrados')->nullable();
            $table->string('visado')->nullable();
            $table->string('lugar')->nullable();
            $table->string('departamento')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('estado',15)->nullable();
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
        Schema::dropIfExists('camadas');
    }
}
