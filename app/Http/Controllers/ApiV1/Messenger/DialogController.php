<?php

namespace App\Http\Controllers\ApiV1\Messenger;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Messenger\Dialog;
use function foo\func;

class DialogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dialogs = Dialog::with(['dialogUsers' => function($q) {
                        $q->where('users.id', '!=', 11); // 11 - Auth::id()
                        $q->select('users.id', 'users.name', 'users.avatar');
                    }])
                    ->with(['dialogMessages' => function($q) {
                        $q->limit(1);
                        $q->select('id', 'user_id', 'dialog_uid', 'message', 'attach', 'created_at');
                        $q->orderBy('created_at', 'desc');
                        $q->with('messageUser');
                    }])
                    ->whereHas('dialogUsers', function($q) {
                        $q->where('user_id', 11); // 11 - Auth::id()
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $dialogs
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
