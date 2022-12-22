<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyBookingCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_booking_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_booking_id')->constrained('rzy_bookings')->onDelete('cascade');
            $table->foreignId('rzy_collection_id')->constrained('rzy_collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rzy_booking_collections');
    }
}
