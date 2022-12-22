<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_agreements', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->uuid('agreement_number');
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_tenant_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_landlord_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_booking_id')->constrained('rzy_bookings')->onDelete('cascade');
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->enum('diplomatic_clause', ['applicable', 'non_applicable'])->nullable();
            $table->tinyInteger('renew_year')->autoIncrement(false)->nullable();
            $table->date('advance_date')->nullable(false);
            $table->date('first_payment_date')->nullable(false);
            $table->string('tenant_sign')->nullable();
            $table->date('tenant_sign_date')->nullable();
            $table->string('landlord_sign')->nullable();
            $table->date('landlord_sign_date')->nullable();
            $table->enum('agreement_status', ['draft', 'pending', 'processing', 'done'])->default('draft');
            $table->enum('agreement_approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('agreement_approval_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('agreement_approval_status_date')->nullable(true);
            $table->longText('agreement_approval_status_note')->nullable(true);
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('rzy_agreements');
    }
}
