<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Mail\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NotifySubscribedCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to subscribed customer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        //One hour is added to compensate for PHP being one hour faster
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        logger($now);

        $messages = Message::get();
        $messages?->where('date_string', $now)->each(function ($message) {
            if ($message->delivered === 'NO') {
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->is_subscribe){
                        dispatch(new SendMailJob($user->email, new NewMessage($user, $message)));
                    }
                }
                $message->delivered = 'YES';
                $message->save();
            }
        });

        return 0;
    }
}
