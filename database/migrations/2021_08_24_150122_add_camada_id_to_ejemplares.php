<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamadaIdToEjemplares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares', function (Blueprint $table) {
            $table->unsignedBigInteger('camada_id')->nullable()->after('kcb');
            $table->foreign('camada_id')->references('id')->on('camadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ejemplares', function (Blueprint $table) {
            $table->dropForeign(['camada_id']);
            $table->dropColumn('camada_id');
        });
    }
}
