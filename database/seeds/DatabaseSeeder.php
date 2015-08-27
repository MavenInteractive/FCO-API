<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('RolesTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CalloutsTableSeeder');
		$this->call('CommentsTableSeeder');
		$this->call('ViewsTableSeeder');
		$this->call('VotesTableSeeder');
		$this->call('UploadsTableSeeder');
		$this->call('CountriesTableSeeder');
	}

}
