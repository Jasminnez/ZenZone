<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UsersCollection;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'username' => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr = array();
            $responseArr['message'] = $validator->errors();
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username
        ]);
        //$token = $user->createToken('myapptoken')->plainTextToken;
        $token = $user->createToken(env('TOKEN'))->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required|string',
        ]);

        //$user = User::where('email', $request['email'])->first();
        $user = new UsersResource(User::with(["user_activities", "comments", "likes"])->where('email', $request['email'])->withCount('user_activities', 'comments', 'likes')->first());
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Incorrect email address or password, please try again',
            ], 401);
        }
        //$token = $user->createToken('myapptoken')->plainTextToken;
        $token = $user->createToken(env('TOKEN'))->plainTextToken;
        
        // var_dump($User);
        // die();
        //$user -> load('user_activities')->withCount('user_activities')->get();
        $response = [
            'user' =>  new UsersResource($user),
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request)
    {
        //auth()->user()->tokens()->delete();
        $request->user()->tokens()->delete();
        return [
            'message' => 'logged out'
        ];
    }
}
