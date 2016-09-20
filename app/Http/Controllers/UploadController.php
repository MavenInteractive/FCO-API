<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Upload;
use App\VideoStream;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;

class UploadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
		$path = storage_path().'/app';

		try {
			$result = Upload::findOrFail($id);

			if (in_array($result->format, array('image/jpg', 'image/jpeg'))) {
				$server = ServerFactory::create([
					'source'   => $path,
					'cache'    => $path.'/cache',
					'response' => new LaravelResponseFactory(),
					'driver'   => 'gd',
					'presets'  => [
						'thumbnail' => ['w' =>  200, 'h' => 200, 'fit' => 'crop'],
						'medium'    => ['w' =>  600, 'h' => 400, 'fit' => 'crop'],
						'large'     => ['w' => 1200, 'h' => 800, 'fit' => 'crop'],
					],
				]);

				if ($request->has('p')) {
					$params = $request->only('p');
				} else {
					$params = array('p' => 'medium');
				}

				return $server->getImageResponse($result->file_url, $params);
			} else {
				$stream = new VideoStream($path.$result->file_url);
				$stream->start();
			}
		} catch (\Exception $error) {
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
