<?php

namespace App\Http\Controllers\ApiV1\Tour;

use Str;
use Auth;
use Storage;
use App\Tour;
use App\TourImage;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    
    
    public function uploadAvatar(Request $request, $id) 
    {
        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 500);

        $this->validate($request, [
            'file' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:10240'
        ]);
        if($request->hasfile('file')) {

            $save_path = 'users/'. Auth::id() . '/tours/' . $id;

            
            $avatar = Image::make($request->file('file'))->fit(320, 320)->encode('jpg', 80);

            Storage::disk('s3')->put($save_path . '/avatar.jpg', $avatar);

            $tour = Tour::where('id', $id)->first();
            $tour->avatar = Storage::disk('s3')->url($save_path . '/avatar.jpg', $avatar);
            $tour->save();

            return response()->json([
                'success' => true,
                'data' => $tour->avatar
            ]);
        }
    }


    public function multiUploader(Request $request, $id)
    {
        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 500);

        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:10240'
        ]);

        if($request->hasfile('files')) {

            $save_path = 'users/'. Auth::id() . '/tours/' . $id;
           
            foreach($request->file('files') as $file)
            {
                $save_name = Str::random(40);
                
                $photo = Image::make($file)
                    ->fit(1200, 700)
                    ->encode('jpg', 80);

                $photo_crop = Image::make($file)
                    ->fit(320, 320)->encode('jpg', 80);

                Storage::disk('s3')->put($save_path . '/' . $save_name . '.jpg', $photo);
                Storage::disk('s3')->put($save_path . '/' . $save_name . '_crop.jpg', $photo_crop);

                $licence = TourImage::create([
                    'tour_id'       => $id,
                    'image'         => Storage::disk('s3')->url($save_path . '/' . $save_name . '.jpg', $photo),
                    'image_crop'    => Storage::disk('s3')->url($save_path . '/' . $save_name . '_crop.jpg', $photo_crop)
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => TourImage::where('tour_id', $id)->get(),
            ]);

        }
    }

    public function multiUploaderDelete(Request $request, $id) {

        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 500);

        TourImage::where('id', $request->get('id'))
                    ->where('tour_id', $id)
                    ->delete();
        
        return response()->json([
            'success' => true,
            'data' => TourImage::where('tour_id', $id)->get(),
        ]);
    }

}
