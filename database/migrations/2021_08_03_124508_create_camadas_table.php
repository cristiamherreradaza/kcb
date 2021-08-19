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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('padre_id')->nullable();
            $table->foreign('padre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('madre_id')->nullable();
            $table->foreign('madre_id')->references('id')->on('ejemplares');
            $table->unsignedBigInteger('criadero_id')->nullable();
            $table->foreign('criadero_id')->references('id')->on('criaderos');
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
            $table->string('recibo')->nullable();


            $table->string('kcb')->nullable();
            $table->string('num_tatuaje')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('color')->nullable();
            $table->string('senias')->nullable();
            $table->string('nombre')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('')->nullable();

            $table->unsignedBigInteger('criadero_id');
            $table->foreign('criadero_id')->references('id')->on('criaderos');
            $table->unsignedBigInteger('raza_id');
            $table->foreign('raza_id')->references('id')->on('razas');
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
