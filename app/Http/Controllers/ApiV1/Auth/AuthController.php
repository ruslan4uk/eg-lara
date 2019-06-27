<?php

namespace App\Http\Controllers\ApiV1\Auth;

use Carbon\Carbon;

use App\Mail\AuthConfirm;
use Illuminate\Support\Facades\Mail;

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
     * Register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'check_data' => 'required',
            ]);
            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            
            $token = Auth::attempt($request->only(['email','password']));

            $user->hash = md5($user->email . $user->created_at);

            // Send email
            Mail::to($request->get('email'))->send(new AuthConfirm($user));

            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token,
            ], 200);
        }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // grab credentials from the request
        try {
            if (!$token = JWTAuth::attempt($credentials)) { // attempt to verify the credentials and create a token for the user
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
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'succcess' => true,
            'data' => JWTAuth::user()
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


    public function confirm(Request $request)
    {

        if(!$request->get('mail') || !$request->get('hash')) {
            return response()->json([
                'success' => false
            ]);
        }

        $user = User::where('email', $request->get('mail'))->firstOrFail();
        if($request->get('hash') == md5($user->email . $user->created_at)) {
            $user->email_verified_at = Carbon::now();
            $user->save();

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
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