<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uploads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type'); // This is either callout or profile.
			$table->string('format'); // In case it's callout this will be video/image.
			$table->string('value'); // This is the id of the callout or user.
			$table->boolean('is_primary'); // In case multiple images has been uploaded only one is primary.
			$table->string('file_url');
			$table->string('thumbnail_url');
			$table->string('status');
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
		Schema::drop('uploads');
	}

}
