<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovieEditorIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_editor_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('movie_id')->nullable();
            $table->string('editor_id')->nullable();
            $table->index(['movie_id', 'editor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_editor_ids');
    }
}
