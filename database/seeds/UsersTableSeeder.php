<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		DB::table('users')->delete();

		DB::table('users')->insert(array(
			'first_name'  => $faker->firstName,
			'last_name'   => $faker->lastName,
			'username'    => 'administrator',
			'email'       => 'hello@inoc.me',
			'password'    => bcrypt('keanfake'),
			'photo'       => 1,
			'role_id'     => 1,
			'category_id' => 1,
			'birth_date'  => $faker->dateTimeBetween('-50 years'),
			'gender'      => 'male',
			'status'      => 'A'
		));

		$data = array();

		foreach (range(1, 19) as $value) {
			$data[] = array(
				'first_name'  => $faker->firstName,
				'last_name'   => $faker->lastName,
				'username'    => $faker->userName,
				'email'       => $faker->safeEmail,
				'password'    => bcrypt('pass1234'),
				'photo'       => rand(1, 50),
				'role_id'     => rand(1, 6),
				'category_id' => rand(1, 13),
				'birth_date'  => $faker->dateTimeBetween('-50 years'),
				'gender'      => 'male',
				'status'      => 'A'
			);
		}

		DB::table('users')->insert($data);
	}

}
