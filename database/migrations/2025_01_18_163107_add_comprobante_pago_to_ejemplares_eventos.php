<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComprobantePagoToEjemplaresEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares_eventos', function (Blueprint $table) {
            $table->string('comprobante_pago')->nullable()->after('tipo_cambio');
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
            $table->dropColumn("comprobante_pago");
        });
    }
}
