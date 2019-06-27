<?php

namespace App\Http\Controllers\ApiV1\Admin;

use App\Mail\ModerateSuccess;
use Illuminate\Support\Facades\Mail;

use App\User;
use SoftDeletes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('active', '>=', 0)->paginate(7);

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::with('userContact')
                    ->with('userContactType')
                    ->with('userLicense')
                    ->with('userService')
                    ->with('userLanguage')
                    ->with(['userCity' => function($q) {
                        $q->with('cityCountry');
                    }])
                    ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $user
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
        if(User::where('id', $id)->update(['active' => $request->get('active')])) 

            $user = User::where('id', $id)->first();

            // Send email
            Mail::to($user->email)->send(new ModerateSuccess($user));

            return response()->json([
                'success' => true
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(User::find($id)->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }
}
