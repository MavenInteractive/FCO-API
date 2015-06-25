<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('name');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('role_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('photo')->nullable();
			$table->string('reset_password_token');
			$table->smallInteger('reset_password_expiration');
			$table->date('birth_date');
			$table->string('gender', 10)->nullable();
			$table->string('status');
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
