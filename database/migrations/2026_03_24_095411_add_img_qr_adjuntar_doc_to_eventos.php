<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgQrAdjuntarDocToEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->string('img_qr_cobro')->nullable()->after('tipo_evento');
            $table->string('adjuntar_documento',2)->nullable()->after('img_qr_cobro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn("img_qr_cobro");
            $table->dropColumn("adjuntar_documento");
        });
    }
}
