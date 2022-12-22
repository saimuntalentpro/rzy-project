<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyOccupiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_occupiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_offer_id')->constrained('rzy_offers')->onDelete('cascade');
            $table->string('name', 150)->nullable(false);
            $table->enum('gender', ['male', 'female', 'other'])->nullable(false);
            $table->string('id_type', 20)->nullable(false);
            $table->string('id_number', 30)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rzy_occupiers');
    }
}
