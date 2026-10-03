<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminWalletsIfMissing extends Migration
{
    /**
     * The local dump has no admin_wallets table, and the 2024 migration was
     * recorded without creating it. Production already has the table, so this
     * is a no-op there. Rollback does not drop the table, because up() is also
     * a no-op when the table already existed.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('admin_wallets')) {
            return;
        }

        Schema::create('admin_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('org_id');
            $table->integer('admin_id');
            $table->decimal('amount', 15, 2)->default(0);
            $table->timestamps();

            $table->index('org_id');
            $table->foreign('org_id')->references('id')->on('organisations')->onDelete('restrict');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        //
    }
}
