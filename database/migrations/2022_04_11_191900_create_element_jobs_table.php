<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_jobs', function (Blueprint $table) {
            $table->id();     
            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->date('date_production');
            $table->tinyInteger('status');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->unsignedBigInteger('job_group_id')->nullable();
            $table->foreign('job_group_id')->references('id')->on('job_groups')->onDelete('cascade');
            
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
        Schema::dropIfExists('element_jobs');
        
    }
}
