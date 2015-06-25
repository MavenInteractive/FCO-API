<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		DB::table('comments')->delete();

		$data = array();

		foreach (range(1, 100) as $value) {
			$data[] = array(
				'user_id'    => rand(1, 20),
				'callout_id' => rand(1, 50),
				'details'    => $faker->sentence(),
				'status'     => 'A'
			);
		}

		DB::table('comments')->insert($data);
	}

}
