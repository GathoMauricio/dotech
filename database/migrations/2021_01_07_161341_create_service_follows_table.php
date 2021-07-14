<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateServiceFollowsTable extends Migration
{
    public function up()
    {
        Schema::create('service_follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('service_id')->nullable();
            $table->biginteger('author_id')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('service_follows');
    }
}
