<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToWhitdrawals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whitdrawals', function (Blueprint $table) {
            $table->string('folio')->after('author_id')->nullable();
            $table->string('paid')->after('document')->nullable();
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
