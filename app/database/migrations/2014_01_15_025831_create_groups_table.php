<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('groups', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });


        Schema::create('group_user', function($table)
        {
            $table->string('role');
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
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
        Schema::drop('group_user');
        Schema::drop('groups');
	}

}