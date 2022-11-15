<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDislikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dislike', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dislike');
    }
}
