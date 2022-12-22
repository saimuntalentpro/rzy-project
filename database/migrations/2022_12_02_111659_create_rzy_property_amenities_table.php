<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyPropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_property_amenities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_amenity_id')->constrained('rzy_amenities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rzy_property_amenities');
    }
}
