<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show user information
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUserInfo(Request $request, $id)
    {
        $user = \App\User::where('id', $id)
            ->with(['userCity' => function($q) {
                $q->with('cityCountry');
            }])
            ->with('userLanguage')
            ->with('userService')
            ->with('userContact')
            ->where('active', 2)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * User tours
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUserTours(Request $request, $id)
    {
        $tours = \App\Tour::where(['user_id' => $id, 'active' => 2])
            ->with('user')
            ->with('tourTiming')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tours
        ],200);
    }

    public function showUserResponses(Request $request, $id)
    {
        $responses = \App\Comment::with('commentAuthor')
            ->where(['page_id' => $id, 'active' => 2])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $responses
        ], 200);
    }
}
