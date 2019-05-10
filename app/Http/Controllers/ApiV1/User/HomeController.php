<?php

namespace App\Http\Controllers\ApiV1\User;

use Auth;
use Validator;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())
                    ->with('userContact')
                    ->with('userLicense')
                    ->with('userService')
                    ->first();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string', 'min:10', 'max:6000'],
            'user_contact.*.type' => ['required'],
            'user_contact.*.text' => ['required']
            /**
             * TODO: validation other attr
             */
        ]);

        $user = Auth::user();

        $user->update($request->only('name', 'about'));
        $user->userService()->sync($request->user_service);
        $user->userLanguage()->sync($request->user_language);

        // Очищаем контакты перед добавлением
        $user->userContact()->delete();
        foreach($request->user_contact as $contact) {
            $user->userContact()
                ->create(['type' => $contact['type'], 'text' => $contact['text']]);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

}
