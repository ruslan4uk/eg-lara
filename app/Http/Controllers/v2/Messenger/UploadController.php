<?php

namespace App\Http\Controllers\v2\Messenger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class UploadController extends Controller
{
    /**
     * @var array
     */
    private $image_extension = ['jpeg','png','jpg','gif'];
    /**
     * @var array
     */
    private $file_extension = ['pdf','doc','docx','xsls','xslsx','zip'];

    public function uploadFiles(Request $request)
    {
        $request->validate([
            'uid'         => 'required',
            'file'     =>  'required|mimes:jpeg,png,jpg,gif,pdf,zip,doc,docx,xsls,xslsx|max:2048'
        ]);

        if($request->has('file'))
        {
            $save_path = 'dialogs/' . $request->get('uid');
            $extension = $request->file('file')->getClientOriginalExtension();

            if(in_array($extension, $this->image_extension))
            {
                // Save image
                $file = [
                    'type' => 'image',
                    'path' => $this->saveCurrentFile($request->get('uid'), $request->file('file'), true)
                ];
            } elseif (in_array($extension, $this->file_extension)) {
                // Save files
                $file = [
                    'type' => 'file',
                    'name' => $request->file('file')->getClientOriginalName(),
                    'path' => $this->saveCurrentFile($request->get('uid'), $request->file('file'))
                ];
            }

        }

        return response()->json([
            'status' => true,
            'files' => $file,
            'uid' => $request->get('uid')
        ], 200);
    }


    /**
     * @param $uid
     * @param $file
     * @param bool $isImage
     * @return bool
     */
    public function saveCurrentFile($uid, $file, $isImage = false)
    {
        $save_path = 'dialogs/' . $uid;
        $fileName = substr(md5($file->getFilename() . time() . Auth::id()), 20);

        if($isImage)
        {
            $image = Image::make($file)
                ->resize(1920, null, function ($constraint) { $constraint->aspectRatio(); } )
                ->encode('jpg', 80);
            $image_crop = Image::make($file)->fit(120, 90)->encode('jpg', 80);
            if (Storage::disk('s3')->put($save_path . '/' . $fileName . '.jpg', $image)
                && Storage::disk('s3')->put($save_path . '/' . $fileName . '_preview.jpg', $image_crop ))
            {
                $path['path_full'] = Storage::disk('s3')->url($save_path . '/' . $fileName . '.jpg');
                $path['path_crop'] = Storage::disk('s3')->url($save_path . '/' . $fileName . '_preview.jpg');
                return $path;
            }
        }

        if (Storage::disk('s3')->putFileAs($save_path, $file, $fileName . '.' . $file->getClientOriginalExtension()))
        {
            $path = Storage::disk('s3')->url($save_path . '/' . $fileName . '.' . $file->getClientOriginalExtension());
            return $path;
        }
        return false;
    }
}
