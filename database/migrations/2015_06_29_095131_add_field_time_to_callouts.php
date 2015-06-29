<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTimeToCallouts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('callouts', function(Blueprint $table)
		{
			$table->string('title')->nullable()->change();
			$table->string('description')->nullable()->change();
			$table->date('details_date')->nullable()->change();
			$table->time('details_time')->nullable()->after('details_date');
			$table->string('details_venue')->nullable()->change();
			$table->string('match_type')->nullable()->after('video');
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
			$table->dropColumn('details_time');
		});
	}

}
