<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->delete();

		DB::table('roles')->insert([
			['description' => 'Fighter', 'status' => 'A'],
			['description' => 'Fight Fan', 'status' => 'A'],
			['description' => 'Trainer', 'status' => 'A'],
			['description' => 'Promoter', 'status' => 'A'],
			['description' => 'Match Maker', 'status' => 'A'],
			['description' => 'Manager', 'status' => 'A']
		]);
	}

}
