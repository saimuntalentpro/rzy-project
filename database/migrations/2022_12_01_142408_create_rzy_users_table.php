<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('email',100)->nullable(false);
            $table->string('password',255)->nullable(false);
            $table->string('name',100)->nullable(false);
            $table->string('last_login',100)->nullable(true);
            $table->string('device_token',500)->nullable(true);
            $table->enum('email_verified', ['0', '1'])->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('otp_verified', ['0', '1'])->default('0');
            $table->timestamp('otp_verified_at')->nullable();
            $table->rememberToken();
            $table->enum('profile_verified', ['0', '1'])->default('0');
            $table->timestamp('profile_verified_at')->nullable();
            $table->enum('login_type', ['facebook', 'gmail', 'apple', 'normal'])->default('normal');
            $table->enum('channel', ['web', 'android', 'ios', 'other'])->nullable(true)->default(null);
            $table->string('social_id',100)->nullable();
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
        Schema::dropIfExists('rzy_users');
    }
}
