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
			'name'     => $faker->name,
			'email'    => 'hello@inoc.me',
			'password' => bcrypt('keanfake'),
			'role_id'  => 1,
			'username' => 'administrator',
			'photo'    => null,
			'app_key'  => null,
			'status'   => 'A'
		));

		$data = array();

		foreach (range(1, 20) as $value) {
			$data[] = array(
				'name'     => $faker->name,
				'email'    => $faker->safeEmail,
				'password' => bcrypt('pass1234'),
				'role_id'  => rand(1, 6),
				'username' => $faker->userName,
				'photo'    => null,
				'app_key'  => null,
				'status'   => 'A'
			);
		}

		DB::table('users')->insert($data);
	}

}
