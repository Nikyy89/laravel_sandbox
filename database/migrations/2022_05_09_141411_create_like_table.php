<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->comment('egyedi rekordazonosító');
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();

            // Constraint-ek
            $table->foreignId('user_id');
            $table->foreignId('posts_id');
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignId('posts_id')->constrained()->onDelete('cascade');
            //$table->foreign('updated_by')->references('id')->on('users');
            //$table->foreign('created_by')->references('id')->on('users');

            // Index-ek
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like');
    }
}
