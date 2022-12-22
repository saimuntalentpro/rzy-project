<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_bookings', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->uuid('booking_number');
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_tenant_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_landlord_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_offer_id')->constrained('rzy_offers')->onDelete('cascade');
            $table->enum('booking_type', ['rent', 'buy', 'sell'])->nullable();
            $table->double('booking_amount','20','2')->nullable(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('booking_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('booking_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('booking_status_date')->nullable(true);
            $table->longText('booking_status_note')->nullable(true);
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
        Schema::dropIfExists('rzy_bookings');
    }
}
