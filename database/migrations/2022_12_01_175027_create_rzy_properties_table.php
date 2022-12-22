<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //WILL ADD REFERENCE COLUMN
    {
        Schema::create('rzy_properties', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->uuid('property_number');
            $table->enum('rental_type', ['whole_unit', 'room'])->nullable(false);
            $table->enum('property_type', ['landed', 'condo', 'hdb'])->nullable(false);
            $table->string('postal_code', 10)->nullable(true);
            $table->string('property_name', 200)->nullable(false);
            $table->foreignId('district_id')->constrained('rzy_districts')->onDelete('cascade');
            $table->foreignId('estate_id')->constrained('rzy_estates')->onDelete('cascade');
            $table->string('address', 400)->nullable(false);
            $table->double('monthly_rental_amount','20','2')->nullable(false);
            $table->date('available_from')->nullable(false);
            $table->bigInteger('floor_size')->autoIncrement(false)->nullable(true);
            $table->bigInteger('room_size')->autoIncrement(false)->nullable(true);
            $table->enum('whole_unit_bed_room', ['1', '2', '3', '4', '5+', 'studio'])->nullable(true);
            $table->enum('whole_unit_bath_room', ['1', '2', '3', '4', '5+'])->nullable(true);
            $table->enum('room_bed_room', ['master_bedroom','bedroom','shared'])->nullable(true);
            $table->enum('room_bath_room', ['attached', 'shared'])->nullable(true);
            $table->enum('leasing_period', ['1', '2'])->nullable(false);
            $table->enum('furnishing', ['unfurnished', 'partially', 'fully'])->nullable(false);
            $table->enum('view', ['city_view', 'park_view', 'swimming_view','lake_view', 'sea_view', 'other_view'])->nullable(false);
            $table->longText('description')->nullable(false);
            $table->string('latitude')->nullable(false);
            $table->string('longitude')->nullable(false);
            $table->enum('booking_status', ['available', 'booking', 'booked'])->default('available');
            $table->enum('progress_state', ['contact', 'schedule', 'offer', 'booking', 'service_fee', 'credit_report', 'agreement', 'key_handover', 'condition_report', 'inventory'])->nullable();
            $table->foreignId('rzy_user_id')->constrained('rzy_users')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('publish_status', ['published', 'unpublished'])->default('unpublished');
            $table->foreignId('publish_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('publish_status_date')->nullable(true);
            $table->enum('ownership_eligibility_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('ownership_eligibility_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('ownership_eligibility_status_date')->nullable(true);
            $table->longText('ownership_eligibility_status_note')->nullable(true);
            $table->enum('hdb_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('hdb_status_by')->constrained('rzy_admins')->onDelete('cascade');
            $table->dateTime('hdb_status_date')->nullable(true);
            $table->longText('hdb_status_note')->nullable(true);
            $table->bigInteger('view_count')->default(0);
            $table->bigInteger('favorite_count')->default(0);
            $table->enum('room_rent_for', ['any', 'female', 'male'])->default('any');
            $table->tinyInteger('property_completion_rate')->autoIncrement(false)->default(0);
            $table->bigInteger('updated_by')->nullable(true);
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
        Schema::dropIfExists('rzy_properties');
    }
}
