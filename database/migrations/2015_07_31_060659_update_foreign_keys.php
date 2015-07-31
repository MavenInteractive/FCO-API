<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('views', function(Blueprint $table)
		{
			$table->dropForeign('views_user_id_foreign');
			$table->dropForeign('views_callout_id_foreign');

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('callout_id')->references('id')->on('callouts')->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::table('votes', function(Blueprint $table)
		{
			$table->dropForeign('votes_user_id_foreign');
			$table->dropForeign('votes_callout_id_foreign');

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('callout_id')->references('id')->on('callouts')->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::table('comments', function(Blueprint $table)
		{
			$table->dropForeign('comments_user_id_foreign');
			$table->dropForeign('comments_callout_id_foreign');

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('callout_id')->references('id')->on('callouts')->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::table('callouts', function(Blueprint $table)
		{
			$table->dropForeign('callouts_user_id_foreign');
			$table->dropForeign('callouts_category_id_foreign');

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_role_id_foreign');
			$table->dropForeign('users_category_id_foreign');

			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Note there's no need to update the foreign key for it will be drop and created at up time.
	}

}
