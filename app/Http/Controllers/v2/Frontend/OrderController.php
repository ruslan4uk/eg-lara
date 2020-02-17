<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\MailSend;
use App\Mail\Order\GuideOrder;
use App\Mail\Order\TouristSuccess;
use App\Models\v2\Front\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function store(Request $request, $id)
    {

        $request->validate([
            'date_start' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'messenger' => ['string', 'max:255'],
        ]);

        // Get guide email address
        $guide = User::with(['tour' => function ($q)use($id) {
            $q->where('id', $id);
        }])->first();

        $order = Order::create([
            'tour_id' => $id,
            'user_id' => Auth::id() ?: null,
            'guide_id' => $guide->id,
            'date_type' => $request->get('date_type'),
            'date_start' => Carbon::parse($request->get('date_start'))->format('Y-m-d H:i:s'),
            'date_end' => $request->get('date_end') ? Carbon::parse($request->get('date_end'))->format('Y-m-d H:i:s') : null,
            'people_count' => $request->get('people_count'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'messenger' => $request->get('messenger'),
            'comment' => $request->get('comment'),
            'hash' => md5($request->get('tour_id') . $request->get('email') . rand(1000, 100000))
        ]);

        // Queue MailSend
        $guideEmail = new GuideOrder($order->id);
        MailSend::dispatch(['email' => $guide->email], $guideEmail)->onConnection('database');


        return response()->json([
            'success' => true,
            'guide' => $guide->name,
            'order_id' => $order->id
        ], 200);
    }


    public function confirm($id, Request $request)
    {
        $order = Order::where('hash', $request->get('hash'))
            ->whereNull('confirmation')
            ->firstOrFail();

        $order->confirmation = now();
        $order->save();

        // Queue MailSend
        $touristEmail = new TouristSuccess($order->id);
        MailSend::dispatch(['email' => $order->email], $touristEmail)->onConnection('database');

        return response()->json([
            'success' => true,
        ]);
    }
}
