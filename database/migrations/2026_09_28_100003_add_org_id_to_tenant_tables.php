<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddOrgIdToTenantTables extends Migration
{
    /**
     * Tenant tables that receive org_id, in the order from doc/10 plus pendTrans.
     *
     * @var array
     */
    protected $tables = [
        'admins',
        'managers',
        'reps',
        'users',
        'wallets',
        'transactions',
        'contribution_plans',
        'contributions',
        'withdrawals',
        'manual_funding_requests',
        'admin_wallets',
        'productcats',
        'products',
        'pendTrans',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $tableName) {
            $this->addOrgId($tableName);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = array_reverse($this->tables);

        foreach ($tables as $tableName) {
            $this->dropOrgId($tableName);
        }
    }

    /**
     * Add nullable org_id, backfill 1, then NOT NULL + restrict FK (or index on MyISAM).
     *
     * @param  string  $tableName
     * @return void
     */
    protected function addOrgId($tableName)
    {
        if (!Schema::hasTable($tableName) || Schema::hasColumn($tableName, 'org_id')) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) {
            $table->unsignedBigInteger('org_id')->nullable();
        });

        DB::table($tableName)->whereNull('org_id')->update(['org_id' => 1]);

        DB::statement('ALTER TABLE `'.$tableName.'` MODIFY `org_id` BIGINT UNSIGNED NOT NULL');

        if ($this->isInnoDb($tableName)) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->foreign('org_id')->references('id')->on('organisations')->onDelete('restrict');
            });
        } else {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index('org_id');
            });
        }
    }

    /**
     * @param  string  $tableName
     * @return void
     */
    protected function dropOrgId($tableName)
    {
        if (!Schema::hasTable($tableName) || !Schema::hasColumn($tableName, 'org_id')) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            if ($this->isInnoDb($tableName)) {
                $table->dropForeign(['org_id']);
            } else {
                $table->dropIndex(['org_id']);
            }

            $table->dropColumn('org_id');
        });
    }

    /**
     * @param  string  $tableName
     * @return bool
     */
    protected function isInnoDb($tableName)
    {
        $row = DB::selectOne(
            'SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?',
            [$tableName]
        );

        return $row && strtolower($row->ENGINE) === 'innodb';
    }
}
