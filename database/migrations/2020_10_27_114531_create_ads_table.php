<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('payment');
            $table->unsignedInteger('count');
            $table->string('gender', 1); // m:male, f:female, b:both
            $table->boolean('service')->default(0);
            $table->boolean('dorm')->default(0);
            $table->string('shifts');
            $table->string('job_type', 1)->default('f');
            $table->text('address');
            $table->text('info')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
