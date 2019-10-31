<?php

namespace App\Http\Controllers\v2\Admin\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Comment;

class HomeController extends Controller
{
    /**
     * Get comment paginate
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        return response()->json([
            'success' => true,
            'data' => Comment::with('commentAuthor')
                        ->with('commentGuide')
                        ->orderBy('id', 'desc')
                        ->paginate(15)
        ], 200);
    }


    public function changeCommentActiveStatus($id, Request $request)
    {
        if(!in_array($request->get('active'), [1,2]))
            return false;

        Comment::where('id', $id)->update(['active' => $request->get('active')]);

        return response()->json([
            'success' => true,
        ], 200);
    }
}
