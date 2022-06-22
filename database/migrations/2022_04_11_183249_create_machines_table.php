<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('titel')->nullable();
            $table->string('default_filter')->nullable();
            $table->string('default_sort')->default(1);
            $table->integer('position')->nullable();
            $table->boolean('export')->default(0);
            $table->boolean('execute')->default(1);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('protection_user_id')->nullable();
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
        Schema::dropIfExists('machines');
    }
}
