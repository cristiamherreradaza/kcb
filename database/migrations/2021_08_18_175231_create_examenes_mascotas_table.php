<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes_mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_anterior',11)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('examen_id')->nullable();
            $table->foreign('examen_id')->references('id')->on('examenes');
            $table->string('aptocriaseleccion_uno',2)->nullable();
            $table->string('aptocriaseleccion_dos',2)->nullable();
            $table->date('fecha_examen')->nullable();
            $table->string('dcf')->nullable();
            $table->string('resultado',500)->nullable();
            $table->string('observacion',500)->nullable();
            $table->string('numero_formulario')->nullable();
            $table->string('revisor')->nullable();
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
        Schema::dropIfExists('examenes_mascotas');
    }
}
