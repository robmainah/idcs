<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('Dob')->after('email');
            // $table->integer('phoneNumber');
            // $table->string('image');
            // $table->string('address');
            // $table->integer('gender');
            // $table->integer('role');
            // $table->integer('depart_id')->unassigned();
            $table->integer('depart_id')->unsigned()->after('role');
            $table->foreign('depart_id')->references('id')->on('mainDepartments')->onDelete('cascade');
            /*$table->integer('depart_id')->after('role');
            $table->foreign('depart_id')->references('id')->on('mainDepartments');*/

            // $table->string('accessLevel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
