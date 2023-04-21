<?php
namespace Amirmahvari\SmsMessage\Broadcasting;

use Illuminate\Notifications\Notification;
use App\Models\User;

class SmsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function send($notifiable, Notification $notification) {
        // Remember that we created the toSms() methods in our notification class
        // Now is the time to use it.
        // In our example. $notifiable is an instance of a User that just signed up.
        $message = $notification->toSms($notifiable);

        if(!$message->isEnable()) return false;
        // Now we hopefully have a instance of a SmsMessage.
        // That we are ready to send to our user.
        // Let's do it :-)
        $message->send();
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param \App\Models\User $user
     * @return array|bool
     */
    public function join(User $user) {
        //
    }
}
