<?php

namespace App\Http\Controllers\ApiV1\TrstProfile;

use Auth;
use Validator;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'avatar' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            // 'about' => ['required', 'string', 'min:10', 'max:6000'],
            // 'user_language' => ['required'],
            // 'user_city_ids' => ['required'],
            'user_contact.*.type' => ['required'],
            'user_contact.*.text' => ['required'],
            // 'user_service' => ['required'],
        ]);

        $user = Auth::user();

        $user->update($request->only('name'));

        // Очищаем контакты перед добавлением
        $user->userContact()->delete();
        foreach($request->user_contact as $contact) {
            $user->userContact()
                ->create(['type' => $contact['type'], 'text' => $contact['text']]);
        }

        if(!$user->active == 2)
            $user->active = 0;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Профиль успешно сохранен!' 
        ]);
    }
}
