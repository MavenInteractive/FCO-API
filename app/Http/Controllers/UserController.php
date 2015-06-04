<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// try {
		// 	$token = JWTAuth::getToken();
		// 	$user  = JWTAuth::toUser($token);
		// } catch (\Exception $error) {
		// 	return response()->json(['error' => 'Unauthorized access.'], Response::HTTP_UNAUTHORIZED);
		// }

		$input = Input::only('q', 'page', 'limit', 'sort');

		if (count($input) > 0) {
			//
		} else {
			//
		}

		$result = User::all();

		if ($result->isEmpty()) {
			return response()->json(['error' => 'No result found.'], Response::HTTP_NO_CONTENT);
		}

		return response()->json($result, Response::HTTP_OK);
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

		if ($result->isEmpty()) {
			return response()->json(['error' => 'No result found.'], Response::HTTP_NO_CONTENT);
		}

		return response()->json($result, Response::HTTP_OK);
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

		if ($result->isEmpty()) {
			return response()->json(['error' => 'No result found.'], Response::HTTP_NO_CONTENT);
		}

		return response()->json($result, Response::HTTP_OK);
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

	/**
	 * Signup to the system.
	 *
	 * @param  none
	 * @return Response
	 */
	public function register()
	{
		$credentials = Input::only('email', 'username', 'password', 'confirm_password');

		if ($credentials['password'] <> $credentials['confirm_password']) {
			return response()->json(['error' => 'Password mismatch.'], Response::HTTP_NOT_ACCEPTABLE);
		}

		try {
			$credentials['password'] = Hash::make($credentials['password']);
			$credentials['role_id']  = 2;

			$user = User::create($credentials);
		} catch (\Exception $error) {
			return response()->json(['error' => 'User already exists.'], Response::HTTP_CONFLICT);
		}

		$token = JWTAuth::fromUser($user);

		return response()->json(compact('token'));
	}

	/**
	 * Login to the system.
	 *
	 * @param  none
	 * @return Response
	 */
	public function login()
	{
		$input = Input::only('email', 'password');

		/* Change $input for Email or Username */
		$credentials = $input;

		try {
			if ( ! $token = JWTAuth::attempt($credentials)) {
				$credentials = ['username' => $input['email'], 'password' => $input['password']];

				if ( ! $token = JWTAuth::attempt($credentials)) {
					return response()->json(['error' => 'Invalid credentials.'], Response::HTTP_NOT_FOUND);
				}
			}
		} catch (\Exception $error) {
			return response()->json(['error' => 'Invalid credentials.'], Response::HTTP_NOT_FOUND);
		}

		return response()->json(compact('token'));
	}

	/**
	 * Reset user password.
	 *
	 * @param  none
	 * @return Response
	 */
	public function reset()
	{

	}

	/**
	 * Logouts the user.
	 *
	 * @param  none
	 * @return Response
	 */
	public function logout()
	{

	}

}
