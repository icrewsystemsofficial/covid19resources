<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('volunteer_id');
            $table->string('type')->default('0');
            $table->text('description');
            $table->string('status')->default('0');
            $table->string('slot_start');
            $table->string('slot_end');
            $table->json('data');
            $table->string('total');
            $table->string('completed')->default('0');
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
        Schema::dropIfExists('missions');
    }
}
