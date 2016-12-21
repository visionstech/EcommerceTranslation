<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
            $table->string('website');
            $table->enum('status', ['Live', 'Suspended','Paused','Deleted']);
            $table->string('email');
            $table->string('name');
            $table->string('adunit_id');
            $table->string('comscore_id');
            $table->string('krux_id');
            $table->smallInteger('overlays');
            $table->smallInteger('infusion');
            $table->smallInteger('dynamic_ads');
            $table->smallInteger('programmatic');
            $table->string('custom_scripting');
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
        Schema::drop('publishers');
    }
}
