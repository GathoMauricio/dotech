<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('technical_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('programed_at')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
