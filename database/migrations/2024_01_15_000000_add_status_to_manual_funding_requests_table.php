<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToManualFundingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('manual_funding_requests') || Schema::hasColumn('manual_funding_requests', 'status')) {
            return;
        }

        Schema::table('manual_funding_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ongoing', 'done', 'reversed', 'failed'])->default('pending')->after('proof_of_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manual_funding_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}