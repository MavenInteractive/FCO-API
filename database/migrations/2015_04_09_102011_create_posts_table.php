<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('title');
			$table->text('description');
			$table->integer('fighter_a')->unsigned();
			$table->integer('fighter_b')->unsigned();
			$table->string('photo');
			$table->string('video');
			$table->date('details_date');
			$table->string('details_venue');
			$table->string('details_broadcast');
			$table->string('details_tickets');
			$table->smallInteger('total_views');
			$table->smallInteger('total_comments');
			$table->string('status');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
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
		Schema::drop('posts');
	}

}
