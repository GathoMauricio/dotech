<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateReceptionsTable extends Migration
{
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('responsable')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('equipment')->nullable();
            $table->text('description')->nullable();
            $table->text('observation')->nullable();
            $table->text('diagnostic')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receptions');
    }
}
