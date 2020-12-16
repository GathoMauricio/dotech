<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyFollowsTable extends Migration
{
    public function up()
    {
        Schema::create('company_follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->bigInteger('author_id');
            $table->text('body');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_follows');
    }
}
