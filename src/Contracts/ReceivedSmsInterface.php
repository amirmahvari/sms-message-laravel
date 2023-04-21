<?php

namespace Amirmahvari\SmsMessage\Contracts;

interface ReceivedSmsInterface
{

    /**
     * @return array[Message]
     */
    public function received(bool $is_seen = true): array;
}
