<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Message/Index', array(
            'messages' => Message::orderBy('created_at', 'desc')->get()->map(
                fn($message): array => array(
                    'id'         => $message->id,
                    'title'      => $message->title,
                    'body'       => $message->body,
                    'time_frame' => $message->time_frame,
                    'delivered'  => $message->delivered,
                    'send_date'  => $message->send_date,
                )),
        ));
    }

    public function getMessages()
    {

        return Message::orderBy('created_at', 'desc')->get();
    }

    /**
     * Save message to database and sent to subscribed customer
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMail(Request $request): JsonResponse
    {
        $message = Message::create(
            array(
                'title'      => $request->get('title'),
                'body'       => $request->get('body'),
                'delivered'  => 'YES',
                'time_frame' => $request->get('time_frame'),
                'send_date'  => Carbon::now(),
            )
        );

        User::where('is_subscribe', true)->get()->map(function ($user) use ($message) {
            dispatch(new SendMailJob($user->email, new NewMessage($user, $message)));
        });

        return response()->json('Mail sent.', 201);
    }
}
