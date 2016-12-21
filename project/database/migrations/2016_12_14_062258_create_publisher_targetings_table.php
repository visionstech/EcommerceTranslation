<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublisherTargetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_targetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publisher_id');
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
        Schema::drop('publisher_targetings');
    }
}
