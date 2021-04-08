<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleHistoryImagesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_history_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vehicle_history_id')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_history_images');
    }
}
