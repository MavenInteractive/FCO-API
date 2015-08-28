<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('categories')->delete();

		DB::table('categories')->insert([
			['description' => 'Boxing', 'status' => 'A'],
			['description' => 'Karate', 'status' => 'A'],
			['description' => 'Kick Boxing', 'status' => 'A'],
			['description' => 'Kung Fu', 'status' => 'A'],
			['description' => 'Judo', 'status' => 'A'],
			['description' => 'Jujutsu', 'status' => 'A'],
			['description' => 'MMA', 'status' => 'A'],
			['description' => 'Taekwondo', 'status' => 'A'],
			['description' => 'Team Warfare', 'status' => 'A'],
			['description' => 'Street', 'status' => 'A'],
			['description' => 'Wrestling', 'status' => 'A']
		]);
	}

}
