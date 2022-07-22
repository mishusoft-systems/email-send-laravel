<?php

namespace Database\Seeders;

use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();

        $events = array(
            array('title'=>'First Meeting', 'description'=>'We are arranged first meeting for every new commers', 'venue'=>'asia'),
            array('title'=>'Annual Meeting', 'description'=>'We are arranged annual meeting for every members', 'venue'=>'america'),
            array('title'=>'Test Meeting', 'description'=>'We are arranged first meeting for every members', 'venue'=>'europe'),
        );

        foreach ($events as $event) {
            call_user_func_array(array(EventController::class, 'createEventWithNotify'), $event);
        }
    }
}
