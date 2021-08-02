<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriaderosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criaderos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('propietario_id');
            $table->foreign('propietario_id')->references('id')->on('users');
            $table->unsignedBigInteger('copropietario_id');
            $table->foreign('copropietario_id')->references('id')->on('users');
            $table->string('nombre',150)->nullable();
            $table->string('registro_fci',15)->nullable();
            $table->string('departamento',50)->nullable();
            $table->date('fecha')->nullable();
            $table->string('modalidad_ingreso',150)->nullable();
            $table->string('direccion',150)->nullable();
            $table->string('celulares',150);
            $table->string('pagina_web')->nullable();
            $table->string('email',200)->nullable();
            $table->string('observacion',300)->nullable();
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
        Schema::dropIfExists('criaderos');
    }
}