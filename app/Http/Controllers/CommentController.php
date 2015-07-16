<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::only('q', 'page', 'limit', 'sort');

		$comment = new Comment;

		try {
			if (isset($input['q'])) {
				$q = json_decode($input['q']);

				if (count($q)) {
					foreach ($q as $key => $value) {
						$comment = ($key == 0) ? $comment->where($key, $value) : $comment->orWhere($key, $value);
					}
				}
			}

			if (isset($input['page'])) {
				$comment = $comment->skip($input['page']);
			}

			if (isset($input['limit'])) {
				$comment = $comment->take($input['limit']);
			}

			if (isset($input['sort'])) {
				$sort = explode(',', $input['sort']);

				if (is_array($sort) && count($sort) > 0) {
					foreach ($sort as $key => $value) {
						$str = trim($value, '+-');

						if (strpos($value, '-') === 0) {
							$comment = $comment->orderBy(trim($str), 'desc');
						} else {
							$comment = $comment->orderBy(trim($str), 'asc');
						}
					}
				} else {
					if (strpos($sort, '-') === 0) {
						$comment = $comment->orderBy(trim($sort, '-'), 'desc');
					} else {
						$comment = $comment->orderBy(trim($sort, '+'), 'asc');
					}
				}
			}

			$comment = $comment->with('user')->with('callout');
			$result  = $comment->get();

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
	public function store()
	{
		$input = Input::only('user_id', 'category_id', 'details', 'status');

		try {
			$comment = Comment::create($input);

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
			$result = Comment::with('user')->with('callout')->findOrFail($id);

			return response()->json($result);
		} catch (\Exception $error) {
			dd($error);
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
			$result = Comment::with('user')->with('callout')->findOrFail($id);

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
			$result = Comment::findOrFail($id);

			$result->details = $request->input('details');

			$result->save();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
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
			$result = Comment::findOrFail($id);

			$result->destroy();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'no_result_found'], Response::HTTP_BAD_REQUEST);
		}
	}

}