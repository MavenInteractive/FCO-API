<?php

use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('views')->delete();

		//DB::table('views')->insert();
	}

}
