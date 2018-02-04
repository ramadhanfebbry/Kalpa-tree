<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller 
{
	/**
	 * @param Request $request
	 * @return type
	 */
	public function index(Request $request)
	{
		$keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $user = User::where('name', 'LIKE', "%$keyword%")
				->orWhere('username', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('phone', 'LIKE', "%$keyword%")
				->orWhere('address', 'LIKE', "%$keyword%")
				->roleUser()
                ->paginate($perPage);
        } else {
            $user = User::roleUser()->paginate($perPage);
        }
		
		return response()->json($user);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id, Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		
		if ($user->id != $id) {
			return response()->json([
				'status' => 403,
				'message' => 'Token not syncronize with parameter user id',
			], 403);
		}
		
		$user = User::where('id', $id)->roleUser()->first();
		if (!$user) {
			return response()->json([
				'status' => 404,
				'status' => 'User is not found',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'data' => $user,
		], 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function updateProfile($id, Request $request)
	{
		$token = JWTAuth::parseToken()->authenticate();
		if ($token->id != $id) {
			return response()->json([
				'status' => 403,
				'message' => 'Token not syncronize with parameter user id',
			], 403);
		}
		
		$user = User::where('id', $id)->roleUser()->first();
		if (!$user) {
			return response()->json([
				'status' => 404,                
				'message' => 'User is not found.',
			], 400);
		}
		
		$validator = \Validator::make($request->all(), [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255',
			'username' => 'required|max:255|unique:users,username,'.$user->id,
			'phone' => 'required',
			'address' => 'required|max:255',
			//'image_base64' => 'required',
			//'image_filename' => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		}
		
		if (!empty($request->image_filename) && !empty($request->image_base64)) {
			$request['image'] = $request->image_filename;
			$only = $request->only(['name', 'email', 'phone', 'address', 'image']);
		} else {
			$only = $request->only(['name', 'email', 'phone', 'address']);
		}
		
		$user->update($only);

		return response()->json([
			'status' => 200,
			'message' => 'Update Profile is success',
			'data' => $user,
		], 200);
	}
}
