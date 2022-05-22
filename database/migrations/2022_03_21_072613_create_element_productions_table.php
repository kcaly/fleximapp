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

            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');

            $table->unsignedBigInteger('articel_id');
            $table->foreign('articel_id')->references('id')->on('articels')->onDelete('cascade');

             
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            
            $table->decimal('weight');
            $table->string('material');
            $table->string('articel_info');
            $table->string('product_info');
            $table->string('order_info');

            $table->unsignedBigInteger('amount')->default(0);
            $table->unsignedBigInteger('done')->default(0);

            $table->date('date_production');           
            $table->tinyInteger('status')->default(0);

            // $table->string('machine')->nullable();
            // $table->string('job_group')->nullable();
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
