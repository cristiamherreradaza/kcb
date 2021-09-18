<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjemplaresEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejemplares_eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('evento_id')->nullable();
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unsignedBigInteger('ejemplar_id')->nullable();
            $table->foreign('ejemplar_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('raza_id')->nullable();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->unsignedBigInteger('categoria_pista_id')->nullable();
            $table->foreign('categoria_pista_id')->references('id')->on('categorias_pistas');
            // $table->string('kcb')->nullable();
            $table->string('extrangero')->nullable();
            $table->string('codigo_nacionalizado')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('color')->nullable();
            $table->string('tatuaje')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('chip')->nullable();
            $table->string('kcb_padre')->nullable();
            $table->string('nombre_padre')->nullable();
            $table->string('kcb_madre')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('criador')->nullable();
            $table->string('propietario')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('ejemplares_eventos');
    }
}
