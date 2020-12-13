<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');

            // items
            $table->string('uid'); // کدرهگیری
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code')->unique();
            $table->string('madadju_code')->unique();
            $table->string('mobile')->unique();
            $table->text('address')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('military_status')->nullable();
            $table->date('english_birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('education')->nullable();
            $table->string('field_of_study')->nullable();
            $table->unsignedSmallInteger('type'); // 1:job. 2:loan

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
        Schema::dropIfExists('people');
    }
}
