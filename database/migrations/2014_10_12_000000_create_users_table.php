<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * The old file created an unused early schema (surname, phoneNumber, role).
     * A fresh deploy needs the tables the application actually reads.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 100);
                $table->string('username', 50)->unique();
                $table->string('email', 100)->unique();
                $table->string('password');
                $table->string('image')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('reps')) {
            Schema::create('reps', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 100);
                $table->string('username', 50)->unique();
                $table->decimal('wallet_balance', 12, 2)->default(0);
                $table->string('email', 100)->unique();
                $table->string('phone', 20)->nullable();
                $table->string('image')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->string('password');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 100);
                $table->string('username', 50)->unique();
                $table->string('email', 100)->nullable()->unique();
                $table->string('accNum', 20)->unique();
                $table->decimal('wallet_balance', 12, 2)->default(0);
                $table->string('phone', 20)->nullable();
                $table->string('profession', 100)->nullable();
                $table->string('education', 100)->nullable();
                $table->text('address');
                $table->date('dob')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->string('nok_name', 100);
                $table->string('nok_phone', 20);
                $table->string('nok_relationship', 50);
                $table->string('password');
                $table->integer('rep_id')->nullable();
                $table->timestamps();
                $table->boolean('is_lock')->default(0);
                $table->text('signature')->nullable();
                $table->text('profile_pix')->nullable();

                $table->foreign('rep_id')->references('id')->on('reps')->onDelete('set null');
            });
        }

        if (!Schema::hasTable('wallets')) {
            Schema::create('wallets', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->unique();
                $table->decimal('savings_wallet', 12, 2)->default(0);
                $table->decimal('business_wallet', 12, 2)->default(0);
                $table->decimal('user_wallet', 12, 2)->default(0);
                $table->timestamps();
                $table->text('amount')->nullable();

                $table->foreign('user_id')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('contribution_plans')) {
            Schema::create('contribution_plans', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->integer('rep_id');
                $table->string('title', 100);
                $table->decimal('amount', 10, 2);
                $table->text('description')->nullable();
                $table->integer('duration');
                $table->date('start_date')->nullable();
                $table->enum('status', ['active', 'completed', 'broken'])->default('active');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('rep_id')->references('id')->on('reps');
            });
        }

        if (!Schema::hasTable('contributions')) {
            Schema::create('contributions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('plan_id');
                $table->decimal('amount', 10, 2);
                $table->text('description')->nullable();
                $table->date('contributed_on')->nullable();
                $table->timestamps();

                $table->foreign('plan_id')->references('id')->on('contribution_plans');
            });
        }

        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->integer('rep_id')->nullable();
                $table->integer('plan_id')->nullable();
                $table->enum('wallet_type', ['savings', 'business', 'user']);
                $table->enum('type', ['credit', 'debit']);
                $table->decimal('amount', 12, 2);
                $table->text('description')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('rep_id')->references('id')->on('reps');
                $table->foreign('plan_id')->references('id')->on('contribution_plans');
            });
        }

        if (!Schema::hasTable('withdrawals')) {
            Schema::create('withdrawals', function (Blueprint $table) {
                $table->engine = 'MyISAM';
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->decimal('amount', 15, 2);
                $table->string('bank_name');
                $table->string('account_number');
                $table->string('account_name');
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->string('signature_path')->nullable();
                $table->timestamps();
                $table->index('user_id');
            });
        }

        if (!Schema::hasTable('manual_funding_requests')) {
            Schema::create('manual_funding_requests', function (Blueprint $table) {
                $table->engine = 'MyISAM';
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->decimal('amount', 15, 2);
                $table->string('proof_of_payment')->nullable();
                $table->timestamps();
                $table->index('user_id');
            });
        }

        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->engine = 'MyISAM';
                $table->increments('id');
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('manual_funding_requests');
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('contributions');
        Schema::dropIfExists('contribution_plans');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('reps');
        Schema::dropIfExists('admins');
    }
}
