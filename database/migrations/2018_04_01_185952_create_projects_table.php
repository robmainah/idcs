<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unique();
            $table->string('name')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->date('reminder_date')->nullable();
            $table->time('reminder_time')->nullable();
            $table->string('reminder_message')->nullable();
            $table->date('target_date')->nullable();
            $table->time('target_time')->nullable();
            $table->string('target_message')->nullable();
            $table->string('description');
            $table->string('target_members');
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
        Schema::dropIfExists('projects');
    }
}
