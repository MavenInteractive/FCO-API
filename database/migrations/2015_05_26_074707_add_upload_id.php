<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->integer('upload_id')->unsigned()->nullable();

			$table->foreign('upload_id')->references('id')->on('uploads')->onUpdate('cascade');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('upload_id')->unsigned()->nullable();

			$table->foreign('upload_id')->references('id')->on('uploads')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropForeign('posts_upload_id_foreign');

			$table->dropColumn('upload_id');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_upload_id_foreign');

			$table->dropColumn('upload_id');
		});
	}

}
