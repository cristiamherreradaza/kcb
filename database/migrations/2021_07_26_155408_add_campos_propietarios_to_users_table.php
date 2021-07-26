<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposPropietariosToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('socio',10)->nullable();
            $table->string('genero',50)->nullable();
            $table->unsignedBigInteger('sucursal_id')->nullable()->after('id');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("surcursal_id");
            $table->dropForeign(["user_id"]);
            $table->dropColumn("user_id");
            $table->dropColumn("socio");
            $table->dropColumn("genero");
        });
    }
}
