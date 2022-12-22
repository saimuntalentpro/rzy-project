<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_amenities', function (Blueprint $table) {
            $table->id();
            $table->enum('rental_type', ['whole_unit', 'room'])->nullable(false);
            $table->enum('property_type', ['landed', 'condo', 'hdb'])->nullable(false);
            $table->string('title', 150)->nullable(false);
            $table->foreignId('created_by')->nullable(false)->constrained('rzy_admins')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('rzy_admins')->onDelete('cascade');
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
        Schema::dropIfExists('rzy_amenities');
    }
}
