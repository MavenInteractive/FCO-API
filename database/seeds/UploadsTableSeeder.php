<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class UploadsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker      = Faker\Factory::create();
		$fileSystem = new Filesystem;

		DB::table('uploads')->delete();

		$data   = array();
		$dir    = config('filesystems.disks.local.root');
		$width  = 800;
		$height = 600;

		foreach (range(1, 50) as $value) {
			$file = $faker->image($dir, $width, $height, 'sports', true, 'Fight Call Out');

			$fileName = $fileSystem->name($file);
			$ext      = $fileSystem->extension($file);
			$mime     = $fileSystem->mimeType($file);

			$data[] = array(
				'type'          => 'callout',
				'format'        => $mime,
				'is_primary'    => true,
				'file_url'      => $fileName . '.' . $ext,
				'thumbnail_url' => $fileName . '.' . $ext,
				'status'        => 'A'
			);
		}

		DB::table('uploads')->insert($data);
	}

}
