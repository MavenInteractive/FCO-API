<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldBroadcastTicketUrl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('callouts', function(Blueprint $table)
		{
			$table->string('broadcast_url')->nullable();
			$table->string('ticket_url')->nullable();
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
			$table->dropColumn('broadcast_url');
			$table->dropColumn('ticket_url');
		});
	}

}
