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
            $table->biginteger('company_id');
            $table->biginteger('department_id');
            $table->biginteger('author_id');
            $table->string('status');
            $table->text('description');
            $table->string('investment');
            $table->string('estimated');
            $table->string('utility');
            $table->string('iva');
            $table->string('commision_percent');
            $table->string('commision_pay');
            $table->date('deadline');
            $table->string('delivery_days');
            $table->string('shipping');
            $table->string('payment_type');
            $table->string('credit');
            $table->string('currency');
            $table->text('observation');
            $table->text('material');
            $table->timestamp('closed_at');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
