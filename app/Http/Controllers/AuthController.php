<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $create_token = $user->createToken('my token')->plainTextToken;
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'create_token' =>  $create_token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request){
        Log::info('moemn');
       $cheak= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        Log::info('1');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Log::info('2');
        // $token = Auth::guard('api')->login($user);
        $create_token = $user->createToken('my token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'create_token' =>  $create_token,
                'type' => 'bearer',
            ]
            
            
        ]);
       
    }
    public function logout(Request $request)
    {
        // Auth::logout();
        $request->user()->currentAccessToken()->delete();
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });
        return response()->noContent();
    }

}
