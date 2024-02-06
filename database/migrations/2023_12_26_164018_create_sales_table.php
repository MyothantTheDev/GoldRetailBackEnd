<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('buyer');
            $table->integer('price')->unsigned();
            $table->integer('gold')->unsigned();
            $table->integer('fee')->unsigned();
            $table->integer('gem')->unsigned();
            $table->integer('polish')->unsigned();
            $table->integer('total')->unsigned();
            $table->integer('discount')->unsigned();
            $table->integer('net')->unsigned();
            $table->foreignUuid('weight')->references('id')->on('weight')->nullOnDelete();
            $table->foreignUuid('encount')->references('id')->on('weight')->nullOnDelete();
            $table->foreignUuid('gem_weight')->references('id')->on('weight')->nullOnDelete();
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
        Schema::dropIfExists('sales');
    }
};
