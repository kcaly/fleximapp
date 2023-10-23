<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('protection_user_id')->nullable();

            $table->unsignedBigInteger('sum_elements_amount');
            $table->unsignedBigInteger('done')->default(0);
            
            $table->unsignedBigInteger('production_id');
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');

            $table->date('date_production')->nullable();
            $table->date('date_production_virtual')->nullable();

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
        Schema::dropIfExists('job_orders');
    }
}
