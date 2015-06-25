<?php

use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		DB::table('votes')->delete();

		$data = array();

		foreach (range(1, 100) as $value) {
			$data[] = array(
				'user_id'    => rand(1, 20),
				'callout_id' => rand(1, 50),
				'tally'      => rand(0, 1),
				'status'     => 'A'
			);
		}

		DB::table('votes')->insert($data);
	}

}
