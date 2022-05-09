<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_productions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->string('material');
            $table->decimal('weight');
            $table->string('machine')->nullable();
            $table->string('job_group')->nullable();

            $table->string('articel_info');
            $table->string('product_info');
            $table->string('order_info');

            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');
             
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
            $table->unsignedInteger('amount');
            $table->date('date_production');           
            $table->string('status');
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
        Schema::dropIfExists('element_productions');
    }
}
