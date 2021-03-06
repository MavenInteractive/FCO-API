<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Upload;
use App\User;
use App\Callout;
use DB;
use Hash;
use Input;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
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
		$input = Input::only('q', 'page', 'limit', 'sort');

		$user = new User;

		try {
			if (isset($input['q'])) {
				$q = explode(',', $input['q']);

				if (count($q)) {
					foreach ($q as $key => $value) {
						$field = explode(':', $value);
						$user = $user->where($field['0'], $field['1']);
					}
				}
			}

			$user = $user->where('status', 'A');

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

			$user   = $user->with('role')->with('category')->with('country');
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
		// Todo transfer registration in here. :D
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
			$result = User::with('role')->with('category')->with('country')->findOrFail($id);

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
	public function callouts($id)
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

			$result = $callout->with('category')->where('user_id', $id)->get();

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
			$result = User::findOrFail($id);

			$data = array();

			foreach (array('first_name', 'last_name', 'email', 'role_id', 'category_id', 'country_id', 'birth_date', 'gender') as $value) {
				if ($request->has($value)) {
					$data[$value] = $request->input($value);
				}
			}

			$result->fill($data);

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
			User::destroy($id);

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'no_result_found'], Response::HTTP_BAD_REQUEST);
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
			$credentials['password']    = Hash::make($credentials['password']);
			$credentials['role_id']     = 2;
			$credentials['category_id'] = 1;
			$credentials['status']      = 'A';

			$user = User::create($credentials);

			Mail::send('emails.register', array(), function($message) use ($credentials) {
				$message->to($credentials['email'])->subject('Fight Callout Registration');
			});
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

		$user = JWTAuth::toUser($token);
		$user = $user->with('role')->with('category')->with('country')->where('id', $user->id)->get();

		return response()->json(['user' => $user['0'], 'token' => $token]);
	}

	/**
	 * Reset user password.
	 *
	 * @param  none
	 * @return Response
	 */
	public function reset()
	{
		$credentials = Input::only('username', 'password', 'new_password', 'confirm_password');

		if ($credentials['new_password'] <> $credentials['confirm_password']) {
			return response()->json(['error' => 'password_mismatch1'], Response::HTTP_NOT_ACCEPTABLE);
		}

		$user = DB::table('users')->where('username', $credentials['username'])->first();

		if ( ! Hash::check($credentials['password'], $user->password)) {
			return response()->json(['error' => 'password_mismatch2'], Response::HTTP_NOT_ACCEPTABLE);
		}

		try {
			$user = User::where('username', $credentials['username'])->firstOrFail();

			$user->password = Hash::make($credentials['new_password']);

			$user->save();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'failed_to_update'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	/**
	 * Send password to the email.
	 *
	 */
	public function password(Request $request)
	{
		try {
			$response = Password::sendResetLink($request->only('email'), function ($message) {
				$message->subject("Password Reset Link");
			});

			switch ($response) {
				case Password::RESET_LINK_SENT:
					return response()->json(['success' => 'reset_link_sent']);

				case Password::INVALID_USER:
					return response()->json(['error' => 'email_not_found'], Response::HTTP_INTERNAL_SERVER_ERROR);
			}
		} catch (\Exception $error) {
			return response()->json(['error' => 'failed_to_send_email'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	/**
	 * Change user photo.
	 *
	 * @param  none
	 * @return Response
	 */
	public function upload(Request $request, $id)
	{
		try {
			$file = $request->file('photo');

			$fileName = $file->getFilename();
			$ext      = $file->getClientOriginalExtension();
			$mime     = $file->getClientMimeType();

			Storage::disk('local')->put($fileName . '.' . $ext, File::get($file));

			$photo = [
				'type'          => 'user',
				'format'        => $mime,
				'is_primary'    => true,
				'file_url'      => $fileName . '.' . $ext,
				'thumbnail_url' => $fileName . '.' . $ext,
				'status'        => 'A'
			];

			$photo = Upload::create($photo);

			$user = User::find($id);
			$user->photo = $photo->id;
			$user->save();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'failed_to_upload'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
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
