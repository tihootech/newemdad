<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('person_id');
            $table->string('uid')->unique();

            $table->string('workshop_name');
            $table->string('license_type');
            $table->string('license_system');
            $table->string('plan_title');
            $table->string('required_finance');
            $table->string('suggested_bank');
            $table->string('insurance_number')->nullable();

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
        Schema::dropIfExists('loan_applies');
    }
}
