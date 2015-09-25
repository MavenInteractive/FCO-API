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

		foreach (range(1, 20) as $user) {
			foreach (range(1, 50) as $callout) {
				$data[] = array(
					'user_id'    => $user,
					'callout_id' => $callout,
					'tally'      => rand(0, 1),
					'status'     => 'A'
				);
			}
		}

		DB::table('votes')->insert($data);
	}

}
