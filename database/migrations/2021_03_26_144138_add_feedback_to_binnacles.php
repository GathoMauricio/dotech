<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddFeedbackToBinnacles extends Migration
{
    public function up()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            $table->text('feedback')->after('firm')->nullable();
        });
    }

    public function down()
    {
        Schema::table('binnacles', function (Blueprint $table) {
            //
        });
    }
}
