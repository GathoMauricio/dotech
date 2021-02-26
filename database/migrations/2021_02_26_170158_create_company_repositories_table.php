<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyRepositoriesTable extends Migration
{
    public function up()
    {
        Schema::create('company_repositories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_repositories');
    }
}
