<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWhitdrawals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whitdrawals', function (Blueprint $table) {
            $table->string('emisor')->after('folio')->nullable();
            $table->string('codigo_estatus')->after('emisor')->nullable();
            $table->string('es_cancelable')->after('codigo_estatus')->nullable();
            $table->string('estado_cfdi')->after('es_cancelable')->nullable();
            $table->string('estatus_cancelacion')->after('estado_cfdi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('whitdrawals', function (Blueprint $table) {
            //
        });
    }
}
