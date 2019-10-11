<?php

namespace App\Http\Controllers\ApiV1\Admin;

use App\User;
use App\Tour;
use App\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_count = User::count();
        $tour_count = Tour::count();
        $comment_count = Comment::count();

        return response()->json([
            'success' => true,
            'data' => [
                'user_count' => $user_count,
                'tour_count' => $tour_count,
                'comment_count' => $comment_count
            ]
        ]);
    }

}
