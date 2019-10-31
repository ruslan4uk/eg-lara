<?php

namespace App\Http\Controllers\v2\Admin\User;

use App\Http\Controllers\Controller;
use App\Mail\ModerateSuccess;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Get all guide user, pafinate
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGuideUser ()
    {
        return response()->json([
           'data' => User::where(function($q) {
                   $q->whereNull('role');
                   $q->orWhere('role', 'guide');
               })
               ->where('active', '>', 0)
               ->orderBy('created_at', 'desc')
               ->paginate(15)
        ], 200);
    }

    /**
     * Get guide user profile
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGuideUserProfile ($id)
    {
        $userProfile = User::with('userContact')
            ->with('userContactType')
            ->with('userLicense')
            ->with('userService')
            ->with('userLanguage')
            ->with(['userCity' => function($q) {
                $q->with('cityCountry')->first();
            }])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $userProfile
        ], 200);
    }

    /**
     * Change status User Guide
     *
     * @param $id
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function changeGuideUserActiveStatus ($id, Request $request)
    {
        if(!in_array($request->get('active'), [1,2]))
            return false;

        User::where('id', $id)->update(['active' => $request->get('active')]);

        // Send email
        if($request->get('active') == 2) {
            $user = User::where('id', $id)->firstOrFail();
            Mail::to($user->email)->send(new ModerateSuccess($user));
        }

        return response()->json([
            'success' => true,
        ], 200);
    }
}
