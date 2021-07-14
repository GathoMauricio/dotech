<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddAddressToCompanyDepartment extends Migration
{
    public function up()
    {
        Schema::table('company_department', function (Blueprint $table) {
            $table->string('address')->after('phone')->nullable();
        });
    }
    public function down()
    {
        Schema::table('company_department', function (Blueprint $table) {
            //
        });
    }
}
