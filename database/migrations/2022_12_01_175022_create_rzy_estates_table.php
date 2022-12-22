<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_estates', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->nullable(false);
            $table->foreignId('created_by')->nullable(false)->constrained('rzy_admins')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('rzy_admins')->onDelete('cascade');
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
        Schema::dropIfExists('rzy_estates');
    }
}
