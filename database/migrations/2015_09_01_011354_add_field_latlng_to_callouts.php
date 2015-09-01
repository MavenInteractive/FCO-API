<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldLatlngToCallouts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('callouts', function(Blueprint $table)
		{
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('callouts', function(Blueprint $table)
		{
			$table->dropColumn('latitude');
			$table->dropColumn('longitude');
		});
	}

}
