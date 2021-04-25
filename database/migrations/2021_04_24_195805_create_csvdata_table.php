<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csvdata', function (Blueprint $table) {
            $table->id();
            $table->text('entry_id')->nullable();
            $table->text('state_patient_number')->nullable();
            $table->text('date_announced')->nullable();
            $table->text('age_bracket')->nullable();
            $table->text('gender')->nullable();
            $table->text('detected_city')->nullable();
            $table->text('detected_district')->nullable();
            $table->text('detected_state')->nullable();
            $table->text('state_code')->nullable();
            $table->text('num_cases')->nullable();
            $table->text('current_status')->nullable();
            $table->text('contracted_from_which_patient_suspected')->nullable();
            $table->text('notes')->nullable();
            $table->text('source_1')->nullable();
            $table->text('source_2')->nullable();
            $table->text('source_3')->nullable();
            $table->text('nationality')->nullable();
            $table->text('type_of_transmission')->nullable();
            $table->text('status_change_date')->nullable();
            $table->text('patient_number')->nullable();
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
        Schema::dropIfExists('csvdata');
    }
}
