<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('company_id')->nullable();
            $table->biginteger('department_id')->nullable();
            $table->biginteger('author_id')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->string('investment')->nullable();
            $table->string('estimated')->nullable();
            $table->string('utility')->nullable();
            $table->string('iva')->nullable();
            $table->string('commision_percent');
            $table->string('commision_pay')->nullable();
            $table->date('deadline')->nullable();
            $table->string('delivery_days')->nullable();
            $table->string('shipping')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('credit')->nullable();
            $table->string('currency')->nullable();
            $table->text('observation')->nullable();
            $table->text('material')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
