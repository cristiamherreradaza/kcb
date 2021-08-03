<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejemplares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('camada_id');
            $table->foreign('camada_id')->references('id')->on('camadas');

            $table->unsignedBigInteger('raza_id');
            $table->foreign('raza_id')->references('id')->on('razas');

            $table->unsignedBigInteger('criadero_id');
            $table->foreign('criadero_id')->references('id')->on('criaderos');

            $table->unsignedBigInteger('propietario_id');
            $table->foreign('propietario_id')->references('id')->on('users');

            $table->unsignedBigInteger('propietario_actual_id');
            $table->foreign('propietario_actual_id')->references('id')->on('users');

            $table->unsignedBigInteger('propietario_padre_id');
            $table->foreign('propietario_padre_id')->references('id')->on('users');

            $table->unsignedBigInteger('propietario_madre_id');
            $table->foreign('propietario_madre_id')->references('id')->on('users');

            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');

            $table->string('num_tatuaje', 150)->nullable();
            $table->string('chip', 150)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('color', 150)->nullable();
            $table->string('senas', 50)->nullable();
            $table->string('nombre', 150)->nullable();
            $table->string('nombre_completo', 350)->nullable();
            $table->string('primero_mostrar', 50)->nullable();
            $table->string('prefijo', 250)->nullable();
            $table->string('variedad', 200)->nullable();
            $table->string('lechigada', 150)->nullable();
            $table->string('sexo', 15)->nullable();
            $table->string('origen', 50)->nullable();
            $table->string('propietario_extranjero', 300)->nullable();
            $table->string('afijo_extranjero', 200)->nullable();
            $table->string('lugar_extranjero', 200)->nullable();
            $table->string('consaiguinidad', 50)->nullable();
            $table->string('hermano', 255)->nullable();
            $table->string('departamento', 50)->nullable();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_nacionalizado')->nullable();

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
        Schema::dropIfExists('ejemplares');
    }
}