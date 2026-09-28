<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSuperadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password = env('SUPERADMIN_PASSWORD');

        if (!$password) {
            throw new \RuntimeException('Set SUPERADMIN_PASSWORD in the environment before running migrations.');
        }

        Schema::create('superadmins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('superadmins')->insert([
            'name' => 'Superadmin',
            'email' => 'superadmin@localhost',
            'username' => 'superadmin',
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmins');
    }
}
