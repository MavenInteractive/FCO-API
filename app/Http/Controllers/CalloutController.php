<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Upload;
use App\Callout;
use App\View;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CalloutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::only('q', 'page', 'limit', 'sort');

		$callout = new Callout;

		try {
			if (isset($input['q'])) {
				$q = json_decode($input['q']);

				if (count($q)) {
					foreach ($q as $key => $value) {
						$callout = ($key == 0) ? $callout->where($key, $value) : $callout->orWhere($key, $value);
					}
				}
			}

			if (isset($input['page'])) {
				$callout = $callout->skip($input['page']);
			}

			if (isset($input['limit'])) {
				$callout = $callout->take($input['limit']);
			}

			if (isset($input['sort'])) {
				$sort = explode(',', $input['sort']);

				if (is_array($sort) && count($sort) > 0) {
					foreach ($sort as $key => $value) {
						$str = trim($value, '+-');

						if (strpos($value, '-') === 0) {
							$callout = $callout->orderBy(trim($str), 'desc');
						} else {
							$callout = $callout->orderBy(trim($str), 'asc');
						}
					}
				} else {
					if (strpos($sort, '-') === 0) {
						$callout = $callout->orderBy(trim($sort, '-'), 'desc');
					} else {
						$callout = $callout->orderBy(trim($sort, '+'), 'asc');
					}
				}
			}

			$callout = $callout->with('user')->with('category');
			$result  = $callout->get();

			if ( ! $result->count()) {
				return response()->json(['error' => 'no_result_found']);
			}

			return response()->json($result);
		} catch (\Exception $error) {
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
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
	public function store(Request $request)
	{
		$input = Input::only('user_id', 'category_id', 'title', 'description', 'fighter_a', 'fighter_b', 'photo', 'video', 'match_type', 'details_date', 'details_time', 'details_venue');

		try {
			$input['total_comments'] = 0;
			$input['total_views']    = 0;
			$input['total_votes']    = 0;
			$input['status']         = 'A';

			$category = Callout::create($input);

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'failed_to_create'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
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
			$result = Callout::with('user')->with('category')->with('comment')->findOrFail($id);

			$result->total_views += 1;
			$result->save();

			View::create([
				'user_id'    => $result->user_id,
				'callout_id' => $result->id,
				'count'      => 1,
				'status'     => 'A'
			]);

			return response()->json($result);
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
		try {
			$result = Callout::with('user')->with('category')->findOrFail($id);

			return response()->json($result);
		} catch (\Exception $error) {
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		try {
			$result = Callout::findOrFail($id);

			$data = array();

			foreach (array('user_id', 'category_id', 'title', 'description', 'fighter_a', 'fighter_b', 'photo', 'video', 'match_type', 'details_date', 'details_time', 'details_venue') as $value) {
				if ($request->has($value)) {
					$data[$value] = $request->input($value);
				}
			}

			$result->fill($data);

			$result->save();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			dd($error);
			return response()->json(['error' => 'failed_to_update'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
			$result = Callout::findOrFail($id);

			$result->destroy();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * Uploads image and video.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function upload(Request $request)
	{
		$input = Input::only('photo', 'video');

		try {
			foreach (['photo', 'video'] as $value) {
				$file = $request->file($value);

				if ( ! $file) {
					continue;
				}

				$fileName = $file->getFilename();
				$ext      = $file->getClientOriginalExtension();
				$mime     = $file->getClientMimeType();

				Storage::disk('local')->put($fileName . '.' . $ext, File::get($file));

				$upload = [
					'type'          => 'callout',
					'format'        => $mime,
					'is_primary'    => true,
					'file_url'      => $fileName . '.' . $ext,
					'thumbnail_url' => $fileName . '.' . $ext,
					'status'        => 'A'
				];

				$upload = Upload::create($upload);

				break;
			}

			return response()->json(['upload' => $upload, 'success' => 'success_message']);
		} catch (\Exception $error) {
			dd($error);
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
	}

}
