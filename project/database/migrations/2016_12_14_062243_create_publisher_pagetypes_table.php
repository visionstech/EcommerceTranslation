<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublisherPagetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_pagetypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publisher_id');
            $table->string('title');
            $table->string('selector');
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
       Schema::drop('publisher_pagetypes');
    }
}
