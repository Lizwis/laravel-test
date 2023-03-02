<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Validator;

class AuthController extends Controller
{
    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);

        return response(['status' => true, 'message' => 'User successfully register.'], 200);
    }


    /**

     * Login api

     *

     * @return \Illuminate\Http\Response

     */

    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'errors' => ["email" => ["Incorret Email or Password !!"]]
            ], 401);
        }



        $accessToken = auth()->user()->createToken('authToken')->plainTextToken;

        return response(['access_token' => $accessToken], 200);
    }

    public function user()
    {
        $user = auth()->user();

        return response()->json(['user' => $user], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([], 201);
    }
}
