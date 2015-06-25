<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalloutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('callouts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('title');
			$table->text('description');
			$table->string('fighter_a');
			$table->string('fighter_b');
			$table->string('photo');
			$table->string('video');
			$table->date('details_date');
			$table->string('details_venue');
			$table->smallInteger('total_comments');
			$table->smallInteger('total_views');
			$table->smallInteger('total_votes');
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
		Schema::drop('callouts');
	}

}
