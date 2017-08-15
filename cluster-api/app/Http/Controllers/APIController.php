<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use Carbon\Carbon;

class APIController extends Controller
{

    public function register(Request $request) {
    	$input = $request->only(['username', 'email', 'password', 'country', 'gender', 'firstname', 'lastname', 'birthdate']);
        $input['birthdate'] = Carbon::parse($input['birthdate']);
    	$input['password'] = Hash::make($input['password']);
    	$user = User::create($input);
        return response()->json(['success'=>true, 'user'=> $user, 'token' => JWTAuth::fromUser($user)]);
    }
    
    public function login(Request $request) {
    	$input = $request->only(['email', 'password']);

    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['success' => false, 'message' => 'wrong email or password.']);
        }
        JWTAuth::setToken($token);
        $user = User::findOrFail(JWTAuth::getPayload()->get('sub'));
        return response()->json(['success' => true, 'token' => $token, 'user' => $user]);
    }

    public function user($id) {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    public function updateUser(Request $request) {
        $authUser = JWTAuth::parseToken()->toUser();
        $authUser->fill($request->all());
        if($authUser['id'] != $request->all()['id']) {
            abort(403, 'Unauthorized action');
        }
        if($authUser->save()) {
            return response()->json(['success'=>true, 'user' => $authUser]);
        } else {
            return response()->json(['message' => 'Unable to save the data']);
        }
    }

    public function listOpenClusters(Request $request) {

        return response()->json(['message' => 'Success']);
    }
}
