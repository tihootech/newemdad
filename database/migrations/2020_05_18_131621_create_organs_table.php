<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organs', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->unsignedInteger('user_id');
            $table->string('state');
            $table->string('city');
            $table->string('in_charge_first_name');
            $table->string('in_charge_last_name');
            $table->string('national_code')->unique();
            $table->string('birth_date');
            $table->string('educations');
            $table->string('workshop_location');
            $table->string('workshop_title');
            $table->text('address');
            $table->string('postal_code');
            $table->string('service');
            $table->string('shifts');
            $table->string('shift_hours');
            $table->string('meal');
            $table->string('payment_amount');
            $table->integer('offered_payment')->nullable();
            $table->string('madadjus_insurance');
            $table->string('full_insurance');
            $table->string('phone')->unique();
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
        Schema::dropIfExists('organs');
    }
}
