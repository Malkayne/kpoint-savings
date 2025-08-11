<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('admins', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name',128);
          $table->string('email',128)->unique();
          $table->string('role',128);
          $table->string('username',128)->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password');
          $table->rememberToken();
          $table->timestamps();
      });

      Schema::create('users', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('surname',128);
          $table->string('firstName',128);
          $table->string('lastName',128);
          $table->string('referral',128)->nullable();
          $table->string('phoneNumber',20)->unique();
          $table->string('email',128)->nullable();
          $table->unsignedBigInteger('accNum')->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password');
          $table->rememberToken();
          $table->timestamps();
      });

      Schema::create('wallets', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->unsignedBigInteger('amount');
          $table->timestamps();
      });

      Schema::create('transactions', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->unsignedBigInteger('amount');
        $table->string('transType',455);
        $table->text('about');

      });
      
      Schema::create('reps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->string('email',128)->unique()->nullable();
            $table->string('username',128)->unique();
            $table->timestamp('email_verified_at')->nullable();
             $table->string('phoneNumber',128)->nullable();
            $table->string('password');
            $table->tinyInteger('isSuspend')->default('0');
            $table->rememberToken();
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

      Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('transactions');

    }
}
