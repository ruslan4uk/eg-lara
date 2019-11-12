<?php

namespace App\Http\Controllers\v2\Guide;

use App\Http\Controllers\Controller;
use App\UserLicense;
use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\v2\Guide\Profile as ProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Helpers\Uploader\ImageUploader;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()) {
            return response()->json([ 'success' => false ]);
        }

        $profile = new ProfileResource(User::where('id', Auth::id())
            ->with('userContact')
            ->with('userLicense')
            ->with('userService')
            ->with('userLanguage')
            ->with('userCity')
            ->with('userFavoriteGuide')
            ->first());

        return response()->json([
            'success' => true,
            'data' => $profile
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($user->role === 'tourist')
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'about' => ['required', 'string', 'min:10', 'max:6000'],
                'user_language' => ['required'],
                'user_city_ids' => ['required'],
                'user_contact.*.type' => ['required'],
                'user_contact.*.text' => ['required'],
                'user_service' => ['required'],
            ]);

            $user->userService()->sync($request->user_service);
            $user->userLanguage()->sync($request->user_language);
            $user->userCity()->sync($request->user_city_ids);

        }

        // Очищаем контакты перед добавлением
        $user->userContact()->delete();
        foreach($request->user_contact as $contact) {
            $user->userContact()
                ->create(['type' => $contact['type'], 'text' => $contact['text']]);
        }

        $user->update($request->only('name', 'about'));

        if(!$user->active == 2)
            $user->active = 1;

        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Upload avatar
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'userAvatar' => ['required', 'mimes:jpg,jpeg,png,JPG,JPEG,PNG', 'max:10240'],
        ]);

        $avatarPath = (new ImageUploader('users/'. Auth::id() . '/userfiles/', $request->file('userAvatar')))->apply('avatar');

        User::where('id', Auth::id())->update(['avatar' => $avatarPath]);

        return response()->json([
            'success' => true,
            'data' => $avatarPath
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function multiUploader(Request $request)
    {

        $this->validate($request, [
            'file' => ['required', 'mimes:jpg,jpeg,png,JPG,JPEG,PNG', 'max:10240'],
        ]);

        if($request->hasfile('file')) {

            $imageOriginalAndCrop = (new ImageUploader('users/'. Auth::id() . '/userfiles/', $request->file('file')))->apply('originalAndCrop');

            $imageOriginalAndCrop = array_merge((array)$imageOriginalAndCrop, ['user_id' => Auth::id()]);

            $licence = UserLicense::create($imageOriginalAndCrop);

            return response()->json([
                'success' => true,
                'data' => UserLicense::findOrFail($licence->id)
            ]);
        }
    }


    /**
     * Delete user license
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function multiUploaderDelete(Request $request) {
        UserLicense::where('id', $request->get('id'))
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
