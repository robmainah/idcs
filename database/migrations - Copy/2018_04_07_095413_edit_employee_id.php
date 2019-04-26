<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEmployeeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('employees', function (Blueprint $table) {
            $table->integer('id')->change();
        });

        Schema::table('departmentHods', function (Blueprint $table) {
            $table->integer('employee_id')->change();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departmentHods', function (Blueprint $table) {
            //
        });
    }
}
