<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposFotoCategoriaJuezToJueces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jueces', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_juez_id')->nullable()->after('sucursal_id');
            $table->foreign('categoria_juez_id')->references('id')->on('categoria_juezes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jueces', function (Blueprint $table) {

            $table->dropForeign(["categoria_juez_id"]);
            $table->dropColumn("categoria_juez_id");
            
        });
    }
}
