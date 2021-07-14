<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateServiceLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('service_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
    }
     public function down()
    {
        Schema::dropIfExists('service_locations');
    }
}
