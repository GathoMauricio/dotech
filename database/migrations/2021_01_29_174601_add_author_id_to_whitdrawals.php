<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddAuthorIdToWhitdrawals extends Migration
{
    public function up()
    {
        Schema::table('whitdrawals', function (Blueprint $table) {
            $table->string('author_id')->after('sale_id')->nullable();
        });
    }
    public function down()
    {
        Schema::table('whitdrawals', function (Blueprint $table) {
            //
        });
    }
}
