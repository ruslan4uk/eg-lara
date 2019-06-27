<?php

namespace App\Http\Controllers\ApiV1\User;

use Auth;
use Validator;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\User as UserResource;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $user = new UserResource(User::where('id', Auth::id())
                        ->with('userContact')
                        ->with('userLicense')
                        ->with('userService')
                        ->with('userLanguage')
                        ->with('userCity')
                        ->first());            
        } else {
            $user = array();
        }

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
        // return response()->json([
        //     'data' => $request->all()
        // ]);
        $request->validate([
            'avatar' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string', 'min:10', 'max:6000'],
            'user_language' => ['required'],
            'user_city_ids' => ['required'],
            'user_contact.*.type' => ['required'],
            'user_contact.*.text' => ['required'],
            'user_service' => ['required'],
            /**
             * TODO: validation other attr
             */
        ]);

        $user = Auth::user();

        $user->update($request->only('name', 'about'));
        $user->userService()->sync($request->user_service);
        $user->userLanguage()->sync($request->user_language);
        $user->userCity()->sync($request->user_city_ids);

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
