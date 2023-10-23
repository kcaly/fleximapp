<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipToElementProductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('element_productions', function (Blueprint $table) {
            $table->unsignedBigInteger('element_job_id')->nullable();
            $table->foreign('element_job_id')->references('id')->on('element_jobs')->onDelete('cascade');

            $table->unsignedBigInteger('production_id')->nullable();
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('element_productions', function (Blueprint $table) {
            $table->dropForeign(['element_job_id']);
            $table->dropForeign(['production_id']);
        });
    }
}
