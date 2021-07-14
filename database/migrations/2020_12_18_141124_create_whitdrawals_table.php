<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhitdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whitdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id')->nullable();
            $table->bigInteger('whitdrawal_provider_id')->nullable();
            $table->bigInteger('whitdrawal_account_id')->nullable();
            $table->bigInteger('whitdrawal_department_id')->nullable();
            $table->string('status')->nullable()->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('invoive')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whitdrawals');
    }
}
