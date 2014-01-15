<?php

use Illuminate\Database\Migrations\Migration;

class AddGroupToEntry extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('entries', function($table)
        {
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups');
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
        Schema::table('entries', function($table)
        {
            $table->dropColumn('group_id');
        });
	}

}