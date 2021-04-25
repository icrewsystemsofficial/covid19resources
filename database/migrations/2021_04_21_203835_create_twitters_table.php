<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('twitters', function (Blueprint $table) {
            $table->id();
            $table->string('tweet_id');
            $table->string('tweet')->length('500');
            $table->string('tweet_timestamp');
            // $table->string('extended_tweet')->nullable();
            $table->string('avatar')->nullable();
            $table->string('username');
            $table->string('fullname')->nullable();
            $table->string('status')->default('0');
            $table->string('retweeted')->default('0');
            $table->string('json')->nullable();
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
        Schema::dropIfExists('twitters');
    }
}
