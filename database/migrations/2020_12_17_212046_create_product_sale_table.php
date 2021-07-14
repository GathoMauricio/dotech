<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductSaleTable extends Migration
{
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id');
            $table->text('description');
            $table->string('unity_price_buy');
            $table->string('unity_price_sell');
            $table->string('quantity');
            $table->string('discount');
            $table->string('total_buy');
            $table->string('total_sell');
            $table->string('utility');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('product_sale');
    }
}
