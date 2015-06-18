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

		$user = new User;

		try {
			if (isset($input['q'])) {
				//$user = $user->where('description', 'like', '%' . $input['q'] . '%');
			}

			if (isset($input['page'])) {
				$user = $user->skip($input['page']);
			}

			if (isset($input['limit'])) {
				$user = $user->take($input['limit']);
			}

			if (isset($input['sort'])) {
				$sort = explode(',', $input['sort']);

				if (is_array($sort) && count($sort) > 0) {
					foreach ($sort as $key => $value) {
						$str = trim($value, '+-');

						if (strpos($value, '-') === 0) {
							$user = $user->orderBy(trim($str), 'desc');
						} else {
							$user = $user->orderBy(trim($str), 'asc');
						}
					}
				} else {
					if (strpos($sort, '-') === 0) {
						$user = $user->orderBy(trim($sort, '-'), 'desc');
					} else {
						$user = $user->orderBy(trim($sort, '+'), 'asc');
					}
				}
			}

			$result = $user->get();

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
			$result = User::findOrFail($id);

			if ( ! $result->count()) {
				return response()->json(['error' => 'no_result_found']);
			}

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
			$result = Callout::findOrFail($id);

			if ( ! $result->count()) {
				return response()->json(['error' => 'no_result_found']);
			}

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
		try {
			$result = User::findOrFail($id);

			$result->destroy();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'bad_request'], Response::HTTP_BAD_REQUEST);
		}
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
			return response()->json(['error' => 'password_mismatch'], Response::HTTP_NOT_ACCEPTABLE);
		}

		try {
			$credentials['password'] = Hash::make($credentials['password']);
			$credentials['role_id']  = 2;

			$user = User::create($credentials);
		} catch (\Exception $error) {
			return response()->json(['error' => 'user_already_exists'], Response::HTTP_CONFLICT);
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
					return response()->json(['error' => 'invalid_credentials'], Response::HTTP_NOT_FOUND);
				}
			}
		} catch (\Exception $error) {
			return response()->json(['error' => 'invalid_credentials'], Response::HTTP_NOT_FOUND);
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
