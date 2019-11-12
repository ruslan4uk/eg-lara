<?php

namespace App\Http\Controllers\v2;

use App\Mail\AuthConfirm;
use App\User;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Get user for JWT auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user() {

        return response()->json([
            'data' =>  JWTAuth::user()
        ]);

    }

    /**
     * Register user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'check_data' => ['required'],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        $token = Auth::attempt($request->only(['email','password']));

        // Send email
//        Mail::to($request->get('email'))->send(new AuthConfirm($user));

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
            if (!Auth::user()->email_verified_at) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'email' => 'Почта не подтверждена',
                        'code' => 12,
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
     * Change user password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'max:64', 'min:6'],
            'new_password' => ['required', 'string', 'max:64', 'min:6'],
        ]);

        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            $obj_user = Auth::user();
            $obj_user->password = Hash::make($request->get('new_password'));
            $obj_user->save();

            return response()->json([
                'status' => true,
                'message' => 'Пароль успешно изменен',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => [
                    'current_password' => [
                        '0' => 'Не правильно введен старый пароль'
                    ]
                ],
            ], 422);
        }
    }


    /**
     * Auth confirm
     *
     * @param Request $request
     * @return void
     */
    public function confirm(Request $request)
    {
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
            ],422);
        }
    }

    /**
     * Resend email for user confirm email address
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmSend(Request $request) {

        $user = User::where('email', $request->get('email'))->firstOrFail();

//        Mail::to($request->get('email'))->send(new AuthConfirm($user));

        return response()->json([
            'success' => true
        ], 200);
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
