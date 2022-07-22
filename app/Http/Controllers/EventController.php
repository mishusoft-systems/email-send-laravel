<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\NewEvent;
use App\Models\Event;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Events', [
            'events' => Event::all()->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'venue' => $event->venue,
                    // 'edit_url' => URL::route('event.edit', $event),
                ];
            }),
            // 'create_url' => URL::route('event.create'),
            // 'update_url' => URL::route('event.create'),
        ]);
    }

    public static function createEventWithNotify(string $title, string $description, string $venue)
    {

        $new_event = new Event();
        $new_event->title = $title;
        $new_event->description = $description;
        $new_event->venue = $venue;
        $new_event->save();


        Event::create(array(
            'title'=> $title,
            'description'=> $description,
            'venue'=> $venue,
        ));

        $users = User::all();

        foreach($users as $user) {
            if ($user->is_subscribe){
                dispatch(new SendMailJob($user->email, new NewEvent($user, $new_event)));
            }
        }

    }
}
