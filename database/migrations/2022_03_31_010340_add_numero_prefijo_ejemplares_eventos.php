<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroPrefijoEjemplaresEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares_eventos', function (Blueprint $table) {
            $table->string('numero_prefijo',20)->nullable()->after('numero');
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
            $table->dropColumn("numero_prefijo");
        });
    }
}
