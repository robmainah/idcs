<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFileShared extends Migration
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
            $table->foreign('sent_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('sent_to')->unsigned();
            $table->foreign('sent_to')->references('id')->on('users');
            $table->integer('seen_by')->unsigned();
            $table->foreign('seen_by')->references('id')->on('users');
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
        Schema::dropIfExists('fileShared');
    }
}
