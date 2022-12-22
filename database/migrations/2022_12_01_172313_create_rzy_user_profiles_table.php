<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_user_id')->constrained('rzy_users')->onDelete('cascade');
            $table->uuid('user_number');
            $table->string('mobile', 20)->nullable();
            $table->string('address', 400)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('nationality', ['singaporean', 'foreigner', 'permanent_resident'])->nullable();
            $table->string('race', 50)->nullable();
            $table->string('nric', 50)->nullable();
            $table->enum('occupation', ['self_employed', 'employed', 'student'])->nullable();
            $table->string('business_name', 200)->nullable();
            $table->string('profile_picture', 200)->nullable();
            $table->enum('user_type', ['tenant', 'landlord', 'agent'])->nullable();
            $table->string('overall_credit_score', 10)->nullable();
            $table->string('combined_credit_score', 10)->nullable();
            $table->string('overall_grade', 100)->nullable();
            $table->string('credit_score_action', 200)->nullable();
            $table->json('previous_profile_data')->nullable();
            $table->json('singpassdata')->nullable();
            $table->enum('profile_approval_status', ['pending', 'hold', 'approved', 'rejected'])->default('pending');
            $table->foreignId('profile_approved_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('profile_approved_status_date')->nullable();
            $table->longText('profile_approved_status_note')->nullable();
            $table->tinyInteger('profile_completion_rate')->autoIncrement(false)->default(0);
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
        Schema::dropIfExists('rzy_user_profiles');
    }
}
