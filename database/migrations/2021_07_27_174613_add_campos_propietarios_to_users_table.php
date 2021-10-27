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
            $table->unsignedBigInteger('modificador_id')->nullable()->after('user_id');
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable()->after('user_id');
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('sucursal_id')->nullable()->after('id');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->unsignedBigInteger('perfil_id')->nullable()->after('id');
            $table->foreign('perfil_id')->references('id')->on('perfils');
            $table->string('ci', 15)->nullable()->after('password');
            $table->string('tipo', 15)->nullable()->after('password');
            $table->string('genero', 50)->nullable()->after('password');
            $table->string('codigo_anterior', 11)->nullable()->after('id');
            $table->string('celulares', 50)->nullable()->after('password');
            $table->string('direccion', 200)->nullable()->after('password');
            $table->string('estado', 30)->nullable()->after('password');
            $table->date('fecha_nacimiento')->nullable()->after('password');
            $table->datetime('deleted_at')->nullable()->after('remember_token');

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
            $table->dropColumn("user_id");
            $table->dropForeign(["modificador_id"]);
            $table->dropColumn("modificador_id");
            $table->dropForeign(["eliminador_id"]);
            $table->dropColumn("eliminador_id");
            $table->dropForeign(["sucursal_id"]);
            $table->dropColumn("sucursal_id");
            $table->dropForeign(['perfil_id']);
            $table->dropColumn('perfil_id');
            $table->dropColumn('ci');
            $table->dropColumn('celulares');
            $table->dropColumn('direccion');
            $table->dropColumn('estado');
            $table->dropColumn('fecha_nacimiento');
            $table->dropColumn('deleted_at');
            $table->dropColumn("tipo");
            $table->dropColumn("genero");
            $table->dropColumn("codigo_anterior");
        });
    }
}
