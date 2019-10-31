<?php

namespace App\Http\Controllers\v2\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Tour;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $guide = User::where(function($q) {
                $q->whereNull('role');
                $q->orWhere('role', 'guide');
            })
            ->where('active', '>', 0)
            ->get();

        $tourist = User::where(function ($q) {
                $q->where('role', 'tourist');
            })->get();

        $tour = Tour::where('active', '>', '0')->get();

        $comment = Comment::where('active', '>', '1')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'guide_count' => $guide->count(),
                'tourist_count' => $tourist->count(),
                'tour_count' => $tour->count(),
                'comment_count' => $comment->count(),
            ]
        ], 200);
    }
}
