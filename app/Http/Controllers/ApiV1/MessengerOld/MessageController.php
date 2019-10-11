<?php

namespace App\Http\Controllers\ApiV1\MessengerOld;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Messenger\Message;
use App\Models\Messenger\Dialog;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\DB;

use App\Events\Messenger\DialogsEvent;
use App\Events\Messenger\MessageEvent;
use function foo\func;

class MessageController extends Controller
{

    public function dialogs()
    {
        // Получаем список диалогов между двумя пользователям и группируем по ид диалога
        $dialogs = Message::where('user_id', Auth::id())
                ->orWhere('user_to_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->groupBy('dialog_uid')
                ->get(['*', DB::raw('MAX(created_at) as created_at')]);

        // Получаем непрочитанные сообщения
        $unreadIds = Message::select(\DB::raw('dialog_uid as dialog_id, count(`user_id`) as messages_count'))
                ->where('user_to_id', Auth::id())
                ->where('is_read', 0)
                ->groupBy('user_id')
                ->get();

        // Сапоставляем непрочитанные сообщения с диалогами (добавляется переменная unread
        $dialogs = $dialogs->map(function($dialogs) use ($unreadIds) {
           $dialogsUnread = $unreadIds->where('dialog_id', $dialogs->dialog_uid)->first();
           $dialogs->unread = $dialogsUnread ? $dialogsUnread->messages_count : 0;
           return $dialogs;
        });

        return response()->json($dialogs, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = [];
        $messages = Message::where('dialog_uid', $request->get('uid'))
                            ->where(function($q) use ($request) {
                                if((int) $request->get('page') !== 1) {
                                    $q->where('id', '<', $request->get('page'));
                                }
                            })
                            ->orderBy('id', 'desc')
                            ->limit(20)
                            ->get();
        if(count($messages) > 0) {
            $paginate = [
                'preview' => $messages->min('id'),
                'next' => $messages->max('id'),
                'from' => $messages->pluck('users')->first()->where('id', '!=', Auth::id())->first()->id,
                'name' => $messages->pluck('users')->first()->where('id', '!=', Auth::id())->first()->name
            ];
        }

        $messagesNotRead = Message::where(['dialog_uid' => $request->get('uid'), 'user_to_id' => Auth::id()])->get();
        foreach ($messagesNotRead as $item)
        {
            $item->update(['is_read' => 1]);
        }


        return response()->json([
            'success' => count($messages) > 0 ? true : false,
            'data' => $messages,
            'paginate' => $paginate
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $message = Message::create([
            'message' => $request->get('text'),
            'user_id' => Auth::id(),
            'user_to_id' => $request->get('user_to_id'),
            'dialog_uid' => $request->get('dialog_uid'),
        ]);

        Message::where(['user_to_id' => Auth::id(), 'dialog_uid' => $request->get('dialog_uid')])->update(['is_read' => 1]);

        broadcast(new DialogsEvent($message));

        // Отправляем в сообщения
        broadcast(new MessageEvent($message));

        return response()->json([
            'data' => $message
        ], 200);
    }

    public function newMessage(Request $request)
    {
        $dialogUid = $this->getOrCreateDialogUid($request);
        $message = Message::create([
            'dialog_uid' =>$dialogUid,
            'user_id' => Auth::id(),
            'user_to_id' => (int) $request->get('user_to_id'),
            'message' => $request->get('text'),
            'attach' => $request->get('attach')
        ]);
        // Отправляем в диалоги
        broadcast(new DialogsEvent($message));

        return response()->json([$message, $dialogUid]);
    }

    public function getOrCreateDialogUid($request) {
        $dialog = Dialog::where('user_id', Auth::id())->orWhere('user_id', $request->get('user_to_id'))->get();
        if(count($dialog) < 2) {
            $dialogUid = md5(time() . $request->get('user_to_id') . Auth::id());
            $createDialog = Dialog::insert([
                ['uid' => $dialogUid, 'user_id' => $request->get('user_to_id')],
                ['uid' => $dialogUid, 'user_id' => Auth::id()]
            ]);
            return $dialogUid;
        }
        return $dialog->first()->uid;
    }
}
