<?php

namespace Amirmahvari\SmsMessage;

use Illuminate\Support\ServiceProvider;

class SmsMessageServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sms_message.php' => config_path('sms_message.php'),
        ]);
    }
}
