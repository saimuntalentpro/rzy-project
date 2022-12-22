<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyPropertyFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_property_facilities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_facility_id')->constrained('rzy_facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rzy_property_facilities');
    }
}
