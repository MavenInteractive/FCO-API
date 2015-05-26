<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Input;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::only('limit');

		if ($input['limit'] > 0) {
			$result = User::take($input['limit'])->get();
		} else {
			$result = User::all();
		}

		if ( ! $result->isEmpty()) {
			return response()->json($result);
		}

		return response()->json(array('error' => 'No result found.'));
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
		$result = User::where('id', $id)->get();

		if ( ! $result->isEmpty()) {
			return response()->json($result);
		}

		return response()->json(array('error' => 'No result found.'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$result = User::where('id', $id)->get();

		if ( ! $result->isEmpty()) {
			return response()->json($result);
		}

		return response()->json(array('error' => 'No result found.'));
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
