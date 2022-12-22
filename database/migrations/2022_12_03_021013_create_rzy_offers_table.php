<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_property_id')->constrained('rzy_properties')->onDelete('cascade');
            $table->foreignId('rzy_tenant_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_landlord_id')->constrained('rzy_users')->onDelete('cascade');
            $table->foreignId('rzy_offer_id')->constrained('rzy_offers')->onDelete('cascade');
            $table->double('offer_amount','20','2')->nullable(false);
            $table->tinyInteger('tenancy_period')->autoIncrement(false)->nullable(false);
            $table->date('commencement_date')->nullable(false);
            $table->text('additional_requirements')->nullable();
            $table->enum('is_tenant_accepted', ['yes', 'no'])->default('no');
            $table->enum('is_landlord_accepted', ['yes', 'no'])->default('no');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->tinyInteger('counter')->autoIncrement(false);
            $table->enum('renew_option', ['yes', 'no'])->default('no');
            $table->tinyInteger('renew_year')->autoIncrement(false);
            $table->foreignId('updated_by')->constrained('rzy_users')->onDelete('cascade');
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
        Schema::dropIfExists('rzy_offers');
    }
}
