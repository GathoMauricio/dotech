<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMaintenanceImagesTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('maintenance_id')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_images');
    }
}
