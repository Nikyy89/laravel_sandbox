<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\LogLevel;
use App\Enum\LogSource;

class CreateSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('log_source')->default('controller');
            $table->longText('log_level');
            $table->bigInteger('user_id')->nullable();
            $table->string('controller')->nullable();
            $table->string('method');
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable();
            $table->string('ip_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_logs');
    }
}
