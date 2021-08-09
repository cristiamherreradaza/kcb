<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropietariosCriaderosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propietarios_criaderos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propietario_id');
            $table->foreign('propietario_id')->references('id')->on('users');
            $table->unsignedBigInteger('criadero_id');
            $table->foreign('criadero_id')->references('id')->on('criaderos');
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
        Schema::dropIfExists('propietarios_criaderos');
    }
}
