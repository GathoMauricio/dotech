<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSalePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id');
            $table->text('description');
            $table->string('amount');
            $table->string('document');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sale_payments');
    }
}
