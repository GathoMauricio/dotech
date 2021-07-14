<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateWhitdrawalProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('whitdrawal_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bank');
            $table->string('account');
            $table->string('pay_type');
            $table->string('rfc');
            $table->text('address');
            $table->string('manager');
            $table->string('phone');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('whitdrawal_providers');
    }
}
