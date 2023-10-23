<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipToElementJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('element_jobs', function (Blueprint $table) {

            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');

            $table->unsignedBigInteger('material_id')->nullable();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');

            $table->unsignedBigInteger('job_group_id')->nullable();
            $table->foreign('job_group_id')->references('id')->on('job_groups')->onDelete('cascade');

            $table->unsignedBigInteger('production_id')->nullable();
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');

            $table->unsignedBigInteger('job_order_id')->nullable();
            $table->foreign('job_order_id')->references('id')->on('job_orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('element_jobs', function (Blueprint $table) {
            $table->dropForeign(['element_id']);
            $table->dropForeign(['material_id']);
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['job_group_id']);
            $table->dropForeign(['production_id']);
        });
    }
}
