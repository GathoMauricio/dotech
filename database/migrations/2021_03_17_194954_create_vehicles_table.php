<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vehicle_type_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('fuel')->nullable();
            $table->string('kilometers')->nullable();
            $table->string('enrollment')->nullable();
            $table->string('year')->nullable();
            $table->string('displacement')->nullable();
            $table->string('power')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
