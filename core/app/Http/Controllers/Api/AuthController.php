<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use DB;
use Hash;
use File;

class AuthController extends Controller 
{
	/**
	 * @param Request $request
	 * @return type
	 */
    public function login(Request $request) 
	{
        $credentials = $request->only('username', 'password');
		$validator = \Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		}

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
					'status' => 401,
					'message' => 'Invalid Credentials'
				], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
				'status' => 400,
				'message' => 'Could Not Create Token'
			], 400);
        }

        $user = User::where('username', $request->username)->roleUser()->first();
		if (!$user) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid Credentials'
			], 401);
		}
		if (!$user->getIsStatusActive()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid Credentials, because this user is blocked or inactive',
			], 401);
		}
		
        $token = JWTAuth::fromUser($user);
        $user['token'] = $token;

        return response()->json([
			'status' => 200,
			'data' => $user,
			'message' => 'Login Success',
		], 200);
    }

	/**
	 * @param Request $request
	 * @return type
	 */
    public function logout(Request $request)
	{
		JWTAuth::parseToken()->invalidate();
		
        return response()->json([
			'status' => 200,
			'message' => 'Logout is success',
		], 200);
    }

	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function changePassword($id, Request $request)
	{
		$user = User::where('id', $id)->roleUser()->first();
		
		$validator = \Validator::make($request->all(), [
			'current_password' => 'required',
			'new_password' => 'required|min:6',
			'confirm_password' => 'required|min:6',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		}
		
		if (!\Hash::check($request->current_password, $user->password)) {
			return response()->json([
				'status' => 400,
				'message' => 'Current Password do not match with database.',
			], 400);
		}
		
		if ($request->new_password != $request->confirm_password) {
			return response()->json([
				'status' => 400,
				'message' => 'New Password do not match with Confirmation Password',
			], 400);
		}
		
		$user->password = bcrypt($request->new_password);
		$user->save();
		
		return response()->json([
			'status' => 200,
			'message' => 'change password is successfully saved.',
			'data' => $user,
		], 200);
	}
	
	/**
	 * @param Request $request
	 */
	public function register(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'username' => 'required|max:255|unique:users',
			'password' => 'required|min:6',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		} else {
			$request['phone'] = ($request->phone == null) ? 0 : $request->phone;
			$request['password'] = bcrypt($request->password);
			$request['roles'] = User::ROLE_USER;
			$request['status'] = User::STATUS_ACTIVE;
			
			$user = User::create($request->all());
			
			return response()->json([
				'status' => 201,
				'message' => 'Register is success',
				'data' => $user,
			], 201);
		}
	}
	
	/**
	 * @param Request $request
	 * @return json
	 */
	public function forgotPassword(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'email' => 'required|email|max:255',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		}
		
		$user = User::where('email', $request->email)->roleUser()->first();
		if (!$user) {
			return response()->json([
				'status' => 404,
				'message' => 'User is not found.',
			], 404);
		}
		
		$password = str_random(8);
		$user->password = bcrypt($password);
		$success = $user->save();
		
		$result = $user;
		$result['new_password'] = $password;
		
		// send email
		
		return response()->json([
			'status' => 200,
			'message' => 'Success, please check your email.',
			'data' => $result,
		], 200);
	}
	
	/**
	 * @param Request $request
	 * @return json
	 */
	public function emailVerification(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'email' => 'required|email|max:255',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			]);
		}
		
		$user = User::where('email', $request->email)->roleUser()->first();
		if (!$user) {
			return response()->json([
				'status' => 404,
				'message' => 'User is not registered.',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'message' => 'This user is registered.',
		], 200);
	}

}
