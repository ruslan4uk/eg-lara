<?php

namespace App\Http\Controllers\ApiV1\User;

use Str;
use Auth;
use Storage;
use App\User;
use App\UserLicense;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    
    
    public function uploadAvatar(Request $request) 
    {
        $this->validate($request, [
            'file' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:10240'
        ]);
        if($request->hasfile('file')) {

            $save_path = 'users/'. Auth::id() . '/userfiles';

            
            $avatar = Image::make($request->file('file'))->fit(320, 320)->encode('jpg', 80);

            Storage::disk('s3')->put($save_path . '/avatar.jpg', $avatar);

            $user = User::where('id', Auth::id())->first();
            $user->avatar = Storage::disk('s3')->url($save_path . '/avatar.jpg', $avatar);
            $user->save();

            return response()->json([
                'success' => true,
                'data' => $user->avatar
            ]);
        }
    }


    public function multiUploader(Request $request)
    {
        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:10240'
        ]);

        if($request->hasfile('files')) {

            $save_path = 'users/'. Auth::id() . '/userfiles';
           
            foreach($request->file('files') as $file)
            {
                $save_name = Str::random(40);
                
                $photo = Image::make($file)
                    ->resize(1200, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg', 80);

                $photo_crop = Image::make($file)
                    ->fit(320, 320)->encode('jpg', 80);

                Storage::disk('s3')->put($save_path . '/' . $save_name . '.jpg', $photo);
                Storage::disk('s3')->put($save_path . '/' . $save_name . '_crop.jpg', $photo_crop);

                $licence = UserLicense::create([
                    'user_id'       => Auth::id(),
                    'image'         => Storage::disk('s3')->url($save_path . '/' . $save_name . '.jpg', $photo),
                    'image_crop'    => Storage::disk('s3')->url($save_path . '/' . $save_name . '_crop.jpg', $photo_crop)
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => UserLicense::where('user_id', Auth::id())->get(),
            ]);

        }
    }

    public function multiUploaderDelete(Request $request) {
        UserLicense::where('id', $request->get('id'))
                    ->where('user_id', Auth::id())
                    ->delete();
        
        return response()->json([
            'success' => true,
            'data' => UserLicense::where('user_id', Auth::id())->get(),
        ]);
    }

}
