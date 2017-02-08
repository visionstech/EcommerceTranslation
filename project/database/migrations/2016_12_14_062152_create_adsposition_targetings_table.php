<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdspositionTargetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adsposition_targetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publisher_id');
            $table->integer('ads_id');
            $table->string('key');
            $table->string('value');
            $table->integer('updated_by');
            $table->string('updated_ip',100);                  
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
        Schema::drop('adsposition_targetings');
    }
}
