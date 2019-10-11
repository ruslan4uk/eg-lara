<?php

namespace App\Http\Controllers\ApiV1\Messenger;

use App\Models\Messenger\Dialog;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Messenger\Message;
use Illuminate\Support\Facades\Auth;
// Events
use App\Events\Messenger\MessageEvent;
use App\Events\Messenger\DialogsEvent;
use App\Events\Messenger\NewDialogEvent;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function show(Request $request, $dialog_uid, $last_id = null)
    {
        $messages = Message::where('dialog_uid', $dialog_uid)
            ->where(function ($q) {
                $q->where('user_id', Auth::id());
                $q->orWhere('user_to_id', Auth::id());
            })
            ->where(function ($q) use ($last_id) {
                if ((int)$last_id) $q->where('id', '<', $last_id);
            })
            ->with('userMessageFrom')
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        // Делаем сообщения прочитанными
        $this->messageRead($dialog_uid);

        return response()->json([
            'success' => true,
            'count' => $messages->count(),
            'page' => $last_id,
            'data' => $messages,
        ], 200);
    }


    public function create(Request $request)
    {
        $dialog_uid = $request->get('dialog_uid')
                            ? $request->get('dialog_uid')
                            : $this->getOrCreateDialogUid($request);

            $message = Message::create([
            'message' => $request->get('message'),
            'attach' => $request->get('attach'),
            'user_id' => Auth::id(),
            'user_to_id' => $request->get('user_to_id'),
            'dialog_uid' => $dialog_uid,
        ]);

        Dialog::where('uid', $request->get('dialog_uid'))->update(['updated_at' => DB::raw('NOW()')]);

        $message = Message::where('id', $message->id)
            ->with('userMessageFrom')
            ->firstOrFail();

        // Делаем сообщения прочитанными
        $this->messageRead($dialog_uid);

        // Отправляем в сообщения
        event(new MessageEvent($message));

        // Уведомления о непрочитанных
        event(new DialogsEvent($message));


        return response()->json([
            'data' => $message
        ], 200);
    }

    public function messageRead($dialog_uid)
    {
        Message::where(['user_to_id' => Auth::id(), 'dialog_uid' => $dialog_uid])->update(['is_read' => 1]);
        return;
    }

    /**
     * Проверка существует ли диалог между пользователями
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|string|null
     */
    public function getOrCreateDialogUid ($request)
    {
        // Есть ли между пользователями диалог?
        $dialog_uid = DB::table('messenger_dialog as dialog')
            ->leftJoin('messenger_dialog as dialogFrom', 'dialog.uid', '=', 'dialogFrom.uid')
            ->where('dialog.user_id', $request->get('user_to_id'))
            ->where('dialogFrom.user_id', Auth::id())
            ->select('dialog.*', 'dialogFrom.*')
            ->first();

        // Если нет то создаем новый диалог
        if(!$dialog_uid)
        {
            $dialog_uid = md5(time() . $request->get('user_to_id') . Auth::id());
            Dialog::insert([
                ['uid' => $dialog_uid, 'user_id' => $request->get('user_to_id')],
                ['uid' => $dialog_uid, 'user_id' => Auth::id()]
            ]);

            // Бродкастим новый диалог юзверю
            $this->onBroadcastNewDialog($dialog_uid, $request->get('user_to_id'));

            return $dialog_uid;
        }
        return $dialog_uid->uid;
    }


    /**
     * Отправляем новый диалог пользователю
     * @param $dialog_uid
     * @param $user_to_id
     */
    public function onBroadcastNewDialog($dialog_uid, $user_to_id)
    {
        $userNewDialogs = Dialog::where('uid', $dialog_uid)->with('userDialogFrom')->get();

        foreach ($userNewDialogs as $newDialog)
        {
            if($newDialog->user_id == Auth::id()) {
                $user_to = $user_to_id;
            } elseif ($newDialog->user_id == $user_to_id) {
                $user_to = Auth::id();
            }
            event(new NewDialogEvent($newDialog, $user_to));
        }
    }

}
