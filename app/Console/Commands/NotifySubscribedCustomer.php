<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Mail\NewMessage;
use App\Models\Message;
use App\Models\SentEmail;
use App\Models\User;
use DateTime;
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
     * @throws \Exception
     */
    private function dateDiffInDays(string $date1, string $date2): float|int
    {
        $earlier = new DateTime($date1);
        $later = new DateTime($date2);

        return $later->diff($earlier)->format("%a"); //3
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle(): int
    {
        //One hour is added to compensate for PHP being one hour faster
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        logger($now);

        // collect scheduled message
        Message::whereNotNull('time_frame')->get()->map(function($message) use ($now) {
            // collect user who are subscribed
            User::where('is_subscribe', true)->get()->map(function($user) use ($now, $message) {
                // verify mail
                $sentMail =  SentEmail::where(array('user' => $user->id, 'message' => $message->id))->get()->first();
                $sendingDuration = $this->dateDiffInDays($sentMail->created_at, $now);
                if (!$sentMail->is_response_found && in_array($sendingDuration, array(3, 7, 14, 18), true)){
                    dispatch(new SendMailJob($user->email, new NewMessage($user, $message)));
                }
            });
        });


        return 0;
    }
}
