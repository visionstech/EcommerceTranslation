<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Live', 'Suspended','Paused','Deleted']);
            $table->integer('publisher_id');
            $table->string('slotname');
            $table->string('container');
            $table->string('positioning');
            $table->string('mobile_sizes');    
            $table->string('tablet_sizes');    
            $table->string('desktop_sizes');    
            $table->integer('lazyload');    
            $table->string('page_type');
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
       Schema::drop('ads');
    }
}
