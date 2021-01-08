<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBinnacleImages extends Migration
{
    public function up()
    {
        Schema::table('binnacle_images', function (Blueprint $table) {
            $table->string('image')->after('author_id')->nullable();
        });
    }
    public function down()
    {
        Schema::table('binnacle_images', function (Blueprint $table) {
            //
        });
    }
}
