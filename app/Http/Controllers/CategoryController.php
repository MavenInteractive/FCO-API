<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * TODO: Make parameter handling reusable to all controllers.
	 * @return Response
	 */
	public function index()
	{
		$input = Input::only('q', 'page', 'limit', 'sort');

		$category = new Category;

		try {
			if (isset($input['q'])) {
				$q = explode(',', $input['q']);

				if (count($q)) {
					foreach ($q as $key => $value) {
						$field = explode(':', $value);
						$category = $category->where($field['0'], $field['1']);
					}
				}
			}

			$category = $category->where('status', 'A');

			if (isset($input['page'])) {
				$category = $category->skip($input['page']);
			}

			if (isset($input['limit'])) {
				$category = $category->take($input['limit']);
			}

			if (isset($input['sort'])) {
				$sort = explode(',', $input['sort']);

				if (is_array($sort) && count($sort) > 0) {
					foreach ($sort as $key => $value) {
						$str = trim($value, '+-');

						if (strpos($value, '-') === 0) {
							$category = $category->orderBy(trim($str), 'desc');
						} else {
							$category = $category->orderBy(trim($str), 'asc');
						}
					}
				} else {
					if (strpos($sort, '-') === 0) {
						$category = $category->orderBy(trim($sort, '-'), 'desc');
					} else {
						$category = $category->orderBy(trim($sort, '+'), 'asc');
					}
				}
			}

			$result = $category->get();

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
		$input = Input::only('description');

		try {
			$input['status'] = 'A';

			$category = Category::create($input);

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
			$result = Category::findOrFail($id);

			return response()->json($result);
		} catch (\Exception $error) {
			return response()->json(['error' => 'no_result_found'], Response::HTTP_BAD_REQUEST);
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
			$result = Category::findOrFail($id);

			return response()->json($result);
		} catch (\Exception $error) {
			return response()->json(['error' => 'no_result_found'], Response::HTTP_BAD_REQUEST);
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
			$result = Category::findOrFail($id);

			$result->description = $request->input('description');

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
			Category::destroy($id);

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'no_result_found'], Response::HTTP_BAD_REQUEST);
		}
	}

}
