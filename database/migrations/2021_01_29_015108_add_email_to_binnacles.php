<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddEmailToBinnacles extends Migration
{
    public function up()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            $table->string('email')->after('firm')->nullable();
        });
    }
    public function down()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            //
        });
    }
}
