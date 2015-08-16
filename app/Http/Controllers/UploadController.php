<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
	public function show($id)
	{
		try {
			$result = Upload::findOrFail($id);

			if (in_array($result->format, array('image/jpg', 'image/jpeg'))) {
				$file = Storage::disk('local')->get($result->file_url);

				return (new Response($file, 200))->header('Content-Type', $result->format);
			} else {
				$fs = Storage::disk('local')->getDriver();

				$stream = $fs->readStream($result->file_url);

				$headers = [
					"Content-Type"        => $fs->getMimetype($result->file_url),
					"Content-Length"      => $fs->getSize($result->file_url),
					"Content-disposition" => "attachment; filename=\"" . basename($result->file_url) . "\"",
				];

				return response()->stream(function() use ($stream) {
					fpassthru($stream);
				}, 200, $headers);
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
