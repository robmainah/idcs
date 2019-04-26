<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileShared extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileShared', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files');

            $table->integer('sent_by')->unsigned();
            $table->foreign('sent_by')->references('id')->on('users');
            $table->integer('sent_to');
            $table->integer('seen_by');
            $table->timestamps();

            // $table->integer('depart_id')->unsigned()->after('role');
            // $table->foreign('depart_id')->references('id')->on('mainDepartments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fileShared');
    }
}
