<?php

namespace App\Http\Controllers\ApiV1\Messenger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Messenger\Dialog;
use App\Models\Messenger\Message;
use Illuminate\Support\Facades\Auth;

class DialogController extends Controller
{
    /**
     * Все диалоги пользователя
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // integer 31 = Auth::id()

        $dialogs_uid = Dialog::where('user_id', Auth::id())->get()->pluck('uid');

        $dialogs = Dialog::whereIn('uid', $dialogs_uid)
            ->where('user_id', '!=', Auth::id())
            ->with('userDialogFrom')
            ->get();

        $unreadIds = Message::select(\DB::raw('dialog_uid as dialog_id, count(`user_id`) as messages_count'))
            ->where('user_to_id', Auth::id())
            ->where('is_read', 0)
            ->groupBy('user_id')
            ->get();

        $dialogs = $dialogs->map(function($dialogs) use ($unreadIds) {
            $dialogsUnread = $unreadIds->where('dialog_id', $dialogs->uid)->first();
            $dialogs->unread = $dialogsUnread ? $dialogsUnread->messages_count : 0;
            return $dialogs;
        });

        return response()->json([
            'success' => true,
            'data' => $dialogs,
            'unread' => $unreadIds
        ]);
    }

    public function create()
    {

    }
}
