<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sapathing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendTrans', function (Blueprint $table) {
           $table->unsignedBigInteger('rep_id')->nullable();
          $table->foreign('rep_id')->references('id')->on('reps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendTrans', function (Blueprint $table) {
            //
        });
    }
}
