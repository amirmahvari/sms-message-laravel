<?php

namespace Amirmahvari\SmsMessage;

use Carbon\Carbon;

class Message
{

    public int $message_id;

    public string $message;

    public string $sender;

    public string $receptor;

    public Carbon $date_at;

    public bool $is_send;

    /**
     * @param Carbon $date_at
     */
    public function dateAt(Carbon $date_at): self
    {
        $this->date_at = $date_at;

        return $this;
    }

    /**
     * @param bool $is_send
     */
    public function isSend(bool $is_send): self
    {
        $this->is_send = $is_send;

        return $this;
    }

    /**
     * @param int $message_id
     */
    public function messageId(int $message_id): self
    {
        $this->message_id = $message_id;

        return $this;
    }

    /**
     * @param string $message
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $receptor
     */
    public function receptor(string $receptor): self
    {
        $this->receptor = $receptor;

        return $this;
    }

    /**
     * @param string $sender
     */
    public function sender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
