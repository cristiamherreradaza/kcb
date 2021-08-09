<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPadresToEjemplares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares', function (Blueprint $table) {

            $table->unsignedBigInteger('padre_id')->nullable()->after('user_id');
            $table->foreign('padre_id')->references('id')->on('ejemplares');

            $table->unsignedBigInteger('madre_id')->nullable()->after('user_id');
            $table->foreign('madre_id')->references('id')->on('ejemplares');
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

            $table->dropForeign(['padre_id']);
            $table->dropColumn('padre_id');

            $table->dropForeign(['madre_id']);
            $table->dropColumn('madre_id');
        });
    }
}
