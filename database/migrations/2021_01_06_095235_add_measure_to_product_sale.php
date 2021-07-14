<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddMeasureToProductSale extends Migration
{
    public function up()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            $table->string('measure')->after('sale_id')->nullable();
        });
    }
    public function down()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            //
        });
    }
}
