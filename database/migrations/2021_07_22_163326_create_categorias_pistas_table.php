<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasPistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_pistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_anterior',11)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nombre',200)->nullable();
            $table->string('desde',10)->nullable();
            $table->string('hasta',10)->nullable();
            $table->string('tipo',50)->nullable();
            $table->string('orden',10)->nullable();
            $table->string('descripcion',500)->nullable();
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
        Schema::dropIfExists('categorias_pistas');
    }
}
