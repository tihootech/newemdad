<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('person_id');
            $table->string('uid')->unique();

            $table->string('skill_type');
            $table->text('interests');
            $table->string('vehicle_type');


            $table->smallInteger('status')->default(1); // 1:fresh, 2:edited, 3:rejected, 4:confirmed
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
        Schema::dropIfExists('job_applies');
    }
}
