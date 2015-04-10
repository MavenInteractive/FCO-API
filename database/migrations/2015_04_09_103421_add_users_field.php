<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('role_id')->unsigned();
			$table->string('username');
			$table->string('photo')->nullable();
			$table->string('app_key')->nullable();
			$table->string('status');

			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_role_id_foreign');

			$table->dropColumn('role_id');
			$table->dropColumn('username');
			$table->dropColumn('photo');
			$table->dropColumn('app_key');
			$table->dropColumn('status');
		});
	}

}
