<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnfavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unfavourites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->comment('egyedi rekordazonosító');
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();

            // Constraint-ek
            $table->foreignId('user_id');
            $table->foreignId('posts_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unfavourites');
    }
}
