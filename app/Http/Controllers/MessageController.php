<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function getUsers(): \Illuminate\Database\Eloquent\Collection
    {

        return User::all();
    }

    public function getMessages(){

        return Message::orderBy('created_at', 'desc')->get();
    }

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse
    {

        $message = new Message();
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();

        if($request->item === "now") {

            $message->delivered = 'YES';
            $message->send_date = Carbon::now();
            $message->save();

            $users = User::all();

            foreach($users as $user) {
                dispatch(new SendMailJob($user->email, new NewArrivals($user, $message)));
            }

            return response()->json('Mail sent.', 201);

        }

        $message->date_string = date("Y-m-d H:i", strtotime($request->send_date));

        $message->save();

        return response()->json('Notification will be sent later.', 201);
    }
}
