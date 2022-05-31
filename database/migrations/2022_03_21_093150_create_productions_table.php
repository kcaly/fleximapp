<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('dates_textcode')->nullable();

            $table->date('date_first')->nullable();
            $table->date('date_last')->nullable();
            $table->string('dates_all')->nullable();

            $table->unsignedBigInteger('sum_elements')->nullable();
            $table->unsignedBigInteger('done')->default(0);
            $table->integer('done_procent')->default(0);
            $table->string('total')->nullable();

            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('productions');
    }
}
