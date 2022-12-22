<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_user_id')->constrained('rzy_users')->onDelete('cascade');
            $table->string('nric_front', 100)->nullable();
            $table->string('nric_back', 100)->nullable();
            $table->string('credit_report', 100)->nullable();
            $table->string('iras_or_cpf', 100)->nullable();
            $table->string('employment_letter', 100)->nullable();
            $table->string('salary_slip', 100)->nullable();
            $table->string('sponsor_guarantee_letter', 100)->nullable();
            $table->string('passport_front', 100)->nullable();
            $table->string('passport_back', 100)->nullable();
            $table->string('admission_letter', 100)->nullable();
            $table->string('student_matriculation_card', 100)->nullable();
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
        Schema::dropIfExists('rzy_user_documents');
    }
}
