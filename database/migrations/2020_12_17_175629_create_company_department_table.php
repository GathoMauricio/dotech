<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('company_department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->string('name');
            $table->string('manager');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_department');
    }
}
