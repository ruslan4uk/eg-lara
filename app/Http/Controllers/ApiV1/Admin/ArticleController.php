<?php

namespace App\Http\Controllers\ApiV1\Admin;

use App\Article;

use Storage;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::paginate(20);

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($article = Article::create()) {
            return response()->json([
                'success' => true,
                'data' => $article
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('articleCity')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'text' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
        ]);
        
        $article = Article::where('id', $id)->update($request->only(['name', 'text', 'active', 'city_id', 'country_id']));

        if($article) {
            return response()->json([
                'success' => true
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Article::find($id)->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }


    /**
     * Avatar uploader
     */
    public function uploadAvatar(Request $request, $id) 
    {
        $this->validate($request, [
            'file' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:10240'
        ]);

        if($request->hasfile('file')) {

            $save_path = 'article/' . $id;

            $avatar = Image::make($request->file('file'))->fit(1920, 800)->encode('jpg', 100);
            $avatar_crop = Image::make($request->file('file'))->fit(320, 320)->encode('jpg', 80);

            // Storage::disk('public')->put($save_path . '/avatar.jpg', $avatar);
            // Storage::disk('public')->put($save_path . '/avatar_crop.jpg', $avatar_crop);

            // $tour = Article::where('id', $id)->first();
            // $tour->avatar = $save_path . '/avatar.jpg';
            // $tour->avatar_crop = $save_path . '/avatar_crop.jpg';

            $tour = Article::where('id', $id)->first();

            $tour->avatar = Storage::disk('s3')->put($save_path . '/avatar.jpg', $avatar);
            $tour->avatar_crop = Storage::disk('s3')->put($save_path . '/avatar_crop.jpg', $avatar_crop);

            $tour->save();

            return response()->json([
                'success' => true,
                'data' => $tour->avatar
            ]);
        }
    }
}
