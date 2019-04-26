<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnDepartId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subDepartments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depart_id')->unsigned()->unique();
            $table->string('name')->unique();
            $table->integer('mainDepartment_id')->unsigned();
            $table->foreign('mainDepartment_id')
                  ->references('id')->on('mainDepartments')->onDelete('cascade');
            $table->bigInteger('hod_id')->unsigned();
            $table->foreign('hod_id')
                  ->references('id')->on('employees')->onDelete('cascade');
            $table->text('description');    
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
        Schema::table('subDepartments', function (Blueprint $table) {
            //
        });
    }
}
