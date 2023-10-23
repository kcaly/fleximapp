<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('titel')->nullable();
            $table->string('default_filter')->nullable();
            $table->string('default_sort')->default(1);
            $table->integer('position')->nullable();
            $table->boolean('export')->default(0);
            $table->boolean('execute')->default(1);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->unsignedBigInteger('autoselect_machine_id')->nullable();
            $table->foreign('autoselect_machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->tinyInteger('method_production')->default(0);

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
        Schema::dropIfExists('job_groups');
    }
}
