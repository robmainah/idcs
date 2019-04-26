<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubDepartmentsTable extends Migration
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
            $table->bigInteger('depart_id');
            $table->string('name');
            $table->integer('mainDeptartment_id');
            $table->integer('hod_id');
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
        Schema::dropIfExists('subDepartments');
    }
}
