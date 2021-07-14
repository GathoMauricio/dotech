<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSaleDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('sale_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id');
            $table->text('description');
            $table->string('document');
            $table->string('inner_identifier');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sale_documents');
    }
}
