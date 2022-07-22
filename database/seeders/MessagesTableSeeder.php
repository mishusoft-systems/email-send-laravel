<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Message::truncate();

       Message::create(
           array(
               'title'=>'First Meeting',
               'body'=>'We are arranged first meeting for every new comers',
               'delivered'=>'NO',
               'time_frame'=> true
           )
       );
    }
}
