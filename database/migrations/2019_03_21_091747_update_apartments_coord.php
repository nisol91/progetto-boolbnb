<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApartmentsCoord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {

            $table->decimal('lat', 8, 2)->nullable();
            $table->decimal('lng', 8, 2)->nullable();
            // in db
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            //
        });
    }
}
