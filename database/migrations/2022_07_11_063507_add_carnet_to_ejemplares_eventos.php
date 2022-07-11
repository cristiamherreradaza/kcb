<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarnetToEjemplaresEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejemplares_eventos', function (Blueprint $table) {
            $table->string('carnet', 50)->nullable()->after('edad');
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
            $table->dropColumn("carnet");
        });
    }
}