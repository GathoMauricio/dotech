<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddFirmToBinnacles extends Migration
{
    public function up()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            $table->string('firm')->after('description')->nullable();
        });
    }
    public function down()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            //
        });
    }
}
