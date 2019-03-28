<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApartmentTableClicks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::table('apartments', function (Blueprint $table) {

             $table->integer('clicks_gen')->default(0);
             $table->integer('clicks_feb')->default(0);
             $table->integer('clicks_mar')->default(0);
             $table->integer('clicks_apr')->default(0);
             $table->integer('clicks_mag')->default(0);
             $table->integer('clicks_giu')->default(0);
             $table->integer('clicks_lug')->default(0);
             $table->integer('clicks_ago')->default(0);
             $table->integer('clicks_set')->default(0);
             $table->integer('clicks_ott')->default(0);
             $table->integer('clicks_nov')->default(0);
             $table->integer('clicks_dic')->default(0);

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
