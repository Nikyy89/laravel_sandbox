<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetflixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netflix', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('country');
            $table->date('release_year');
            $table->string('duration');
            $table->string('category');
            $table->string('description');
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
        Schema::dropIfExists('netflix');
    }
}
