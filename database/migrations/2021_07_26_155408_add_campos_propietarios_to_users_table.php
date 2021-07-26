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
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('sucursale_id')->nullable()->after('id');
            $table->foreign('sucursale_id')->references('id')->on('sucursales');
            $table->string('socio',10)->nullable()->after('ci');
            $table->string('genero',50)->nullable()->after('ci');
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
            $table->dropForeign(["sucursale_id"]);
            $table->dropColumn("sucursale_id");
            $table->dropForeign(["user_id"]);
            $table->dropColumn("user_id");
            $table->dropColumn("socio");
            $table->dropColumn("genero");
        });
    }
}
