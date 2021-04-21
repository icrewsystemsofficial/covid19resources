<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('1');
            $table->string('title');
            $table->text('body');
            $table->string('phone')->nullable();
            $table->string('url')->nullable();
            $table->string('author_id')->nullable();
            $table->string('verified')->default('0');
            $table->string('verified_by')->nullable();
            $table->string('hasAddress')->default('0');
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('landmark')->nullable();
            $table->string('coordinates')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
