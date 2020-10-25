<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('organ_id');
            $table->unsignedSmallInteger('age_from')->nullable();
            $table->unsignedSmallInteger('age_to')->nullable();
            $table->text('educations')->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('academic_orientation')->nullable();
            $table->string('health_status')->nullable();
            $table->text('disability_type')->nullable();
            $table->text('disability_level')->nullable();
            $table->text('skill_type')->nullable();
            $table->text('vehicle_type')->nullable();
            $table->boolean('fresh')->default(1);
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
        Schema::dropIfExists('solicits');
    }
}
