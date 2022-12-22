<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_collections', function (Blueprint $table) {
            $table->id();
            $table->uuid('collection_number');
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_tenant_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_landlord_id')->constrained('rzy_users')->onDelete('cascade');
            $table->enum('purpose', ['rzy_booking_fee', 'rzy_first_month_rental_fee', 'rzy_stamp_duty_fee', 'rzy_monthly_rental_fee', 'rzy_monthly_fee', 'rzy_insurance_fee', 'rzy_refund_fee'])->nullable(false);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->double('collection_amount','20','2')->nullable(false);
            $table->dateTime('collection_date')->nullable(false);
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
        Schema::dropIfExists('rzy_collections');
    }
}
