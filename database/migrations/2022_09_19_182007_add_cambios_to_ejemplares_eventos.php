<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCambiosToEjemplaresEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares_eventos', function (Blueprint $table) {
            $table->string('cambio_categoria')->nullable()->after('estado');
            $table->string('tipo_cambio')->nullable()->after('cambio_categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ejemplares_eventos', function (Blueprint $table) {
            $table->dropColumn("cambio_categoria");
            $table->dropColumn("tipo_cambio");
        });
    }
}
