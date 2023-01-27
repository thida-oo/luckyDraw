<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sellouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellouts', function (Blueprint $table) {
            $table->id();
            $table->string('imei_sn');
            $table->string('imei_sn_2');
            $table->string('box_id');
            $table->integer('area_id');
            $table->integer('sku_id');
            $table->string('distributor_code');
            $table->string('store_code');
            $table->string('verifier_id');
            $table->dateTime('verification_time');
            $table->dateTime('registered_time');
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
        //
    }
}
