<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use Carbon\Carbon;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function register(Request $request)
    {        
    	$input = $request->only(['username', 'email', 'password', 'country', 'gender', 'firstname', 'lastname', 'birthdate']);
        $input['birthdate'] = Carbon::parse($input['birthdate']);
    	$input['password'] = Hash::make($input['password']);
    	$user = User::create($input);
        return response()->json(['success'=>true, 'user'=> $user, 'token' => JWTAuth::fromUser($user)]);
    }
    
    public function login(Request $request)
    {
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
