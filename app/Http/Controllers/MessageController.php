<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Messages', array(
            'messages' => Message::orderBy('created_at', 'desc')->get()->map(function ($message) {
                return array(
                    'id' => $message->id,
                    'title' => $message->title,
                    'body' => $message->body,
                    'delivered' => $message->delivered,
                    'send_date' => $message->send_date,
                    // 'edit_url' => URL::route('event.edit', $event),
                );
            }),
            // 'create_url' => URL::route('event.create'),
            // 'update_url' => URL::route('event.create'),
        ));
    }

    public function getUsers(): \Illuminate\Database\Eloquent\Collection
    {

        return User::all();
    }

    public function getMessages()
    {

        return Message::orderBy('created_at', 'desc')->get();
    }

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse
    {

        $message = new Message();
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();

        if ($request->item === "now") {

            $message->delivered = 'YES';
            $message->send_date = Carbon::now();
            $message->save();

            $users = User::all();

            foreach ($users as $user) {
                dispatch(new SendMailJob($user->email, new NewMessage($user, $message)));
            }

            return response()->json('Mail sent.', 201);

        }

        $message->date_string = date("Y-m-d H:i", strtotime($request->send_date));

        $message->save();

        return response()->json('Notification will be sent later.', 201);
    }
}
