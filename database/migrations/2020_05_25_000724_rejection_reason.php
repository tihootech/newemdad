<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RejectionReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organs', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
        Schema::table('job_applies', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
        Schema::table('insurance_applies', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
        Schema::table('loan_applies', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organs', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
        Schema::table('job_applies', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
        Schema::table('insurance_applies', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
        Schema::table('loan_applies', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
    }
}
