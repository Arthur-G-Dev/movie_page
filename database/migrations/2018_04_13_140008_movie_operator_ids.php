<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovieOperatorIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_operator_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('movie_id')->nullable();
            $table->string('operator_id')->nullable();
            $table->index(['movie_id', 'operator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_operator_ids');
    }
}
