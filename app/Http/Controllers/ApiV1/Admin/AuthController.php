<?php

namespace App\Http\Controllers\ApiV1\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // grab credentials from the request
        $token = JWTAuth::attempt($credentials);
        try {
            if (!$token) { // attempt to verify the credentials and create a token for the user
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'email' => 'Неправильный логин или пароль'
                    ]
                ], 422);
            }
            if(!JWTAuth::user()->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'email' => 'Неправильный логин или пароль'
                    ]
                ], 422);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500); // something went wrong whilst attempting to encode the token
        }

        return response()->json([
            'success' => true,
            'data' => Auth::user(),
            'token' => $token,
        ]);

    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['success' => 'true']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}