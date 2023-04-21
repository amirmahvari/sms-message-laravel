<?php

namespace Amirmahvari\SmsMessage\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * SEOMeta is a facade for the `MetaTags` implementation access.
 *
 * @see \Amirmahvari\SmsMessage\SmsMessage
 * @method
 * @method static \Amirmahvari\SmsMessage\SmsMessage to(string $to)
 * @method static \Amirmahvari\SmsMessage\SmsMessage line(string $line)
 * @method static \Amirmahvari\SmsMessage\SmsMessage template($template, $parameters = [])
 * @method static \Amirmahvari\SmsMessage\SmsMessage pattern(string $key, $parameters = [])
 * @method static \Amirmahvari\SmsMessage\SmsMessage status(bool $is_enable)
 * @method static \Amirmahvari\SmsMessage\SmsMessage from(string $from)
 * @method static \Amirmahvari\SmsMessage\SmsMessage credit()
 * @method static send()
 * @method static send_template()
 */
class SmsUtility extends Facade
{

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return config('sms_message.bridge');
    }
}
