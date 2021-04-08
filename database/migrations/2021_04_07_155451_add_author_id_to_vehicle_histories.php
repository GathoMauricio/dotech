<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddAuthorIdToVehicleHistories extends Migration
{
    public function up()
    {
        Schema::table('vehicle_histories', function (Blueprint $table) {
            $table->bigInteger('author_id')->after('id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('vehicle_histories', function (Blueprint $table) {
            //
        });
    }
}
