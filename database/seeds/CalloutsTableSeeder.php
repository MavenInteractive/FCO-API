<?php

use Illuminate\Database\Seeder;

class CalloutsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		DB::table('callouts')->delete();

		$data = array();

		foreach (range(1, 50) as $value) {
			$data[] = array(
				'user_id'        => rand(1, 20),
				'category_id'    => rand(1, 11),
				'title'          => $faker->sentence(),
				'description'    => $faker->sentence(),
				'fighter_a'      => $faker->firstNameMale,
				'fighter_b'      => $faker->firstNameMale,
				'photo'          => rand(1, 50),
				'video'          => rand(1, 50),
				'match_type'     => rand(1, 50),
				'details_date'   => $faker->dateTimeBetween('now', '1 year'),
				'details_time'   => $faker->time(),
				'details_venue'  => $faker->address,
				'total_comments' => rand(1, 100),
				'total_views'    => rand(1, 100),
				'total_votes'    => rand(1, 100),
				'status'         => 'A'
			);
		}

		DB::table('callouts')->insert($data);
	}

}
