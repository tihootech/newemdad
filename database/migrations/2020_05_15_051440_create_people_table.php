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
            $table->string('state');
            $table->string('city');
            $table->string('lifestyle');
            $table->text('address');
            $table->string('postal_code');
            $table->string('national_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('birth_certificate_number');
            $table->string('birth_date');
            $table->date('english_birth_date');
            $table->string('reference')->nullable();
            $table->string('madadkar_name')->nullable();
            $table->string('marital_status');
            $table->unsignedSmallInteger('family_members');
            $table->string('gender');
            $table->string('education');
            $table->string('field_of_study')->nullable();
            $table->string('academic_orientation')->nullable();
            $table->string('warden_type');
            $table->string('health_status');
            $table->unsignedSmallInteger('disables_in_family');
            $table->string('mobile');
            $table->text('information')->nullable();

            $table->string('payed')->nullable();
            $table->string('activity_section')->nullable();
            $table->string('housing_status')->nullable();
            $table->string('mortgage')->nullable();
            $table->string('rent')->nullable();

            // file related
            $table->string('file_domain')->nullable();;
            $table->string('file_status')->nullable();
            $table->string('disability_type')->nullable();;
            $table->string('disability_level')->nullable();;
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
