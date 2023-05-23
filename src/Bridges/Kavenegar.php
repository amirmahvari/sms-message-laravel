<?php

namespace Amirmahvari\SmsMessage\Bridges;

use Amirmahvari\SmsMessage\Contracts\ReceivedSmsInterface;
use Amirmahvari\SmsMessage\Message;
use Amirmahvari\SmsMessage\SmsMessage;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Kavenegar\Laravel\Facade;

class Kavenegar extends SmsMessage implements ReceivedSmsInterface
{

    public function send()
    {
        if(!$this->to)
        {
            throw new \Exception('Sms receiver not defined');
        }
        if(!count($this->lines) and empty($this->template))
        {
            throw new \Exception('Message or template not set');
        }
        try
        {
            if($this->template)
            {
                $parameters = array_values($this->parameters);
                $result = Facade::VerifyLookup($this->to,
                    $parameters[0],
                    @$parameters[1],
                    @$parameters[2],
                    $this->template);

                return true;
            }
            else
            {
                $to = is_array($this->to) ? $this->to : [$this->to];
                $result = Facade::Send($this->from, $to, join("\n", $this->lines));

                return true;
            }
        } catch(\Kavenegar\Exceptions\ApiException $e)
        {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            Log::error($e->errorMessage());

            return false;
        } catch(\Kavenegar\Exceptions\HttpException $e)
        {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            Log::error($e->errorMessage());

            return false;
        }
    }

    public function credit(): float
    {
        try
        {
            $result = Facade::AccountInfo();

            return $result->remaincredit / 10;
        } catch(Exception $exception)
        {
            Log::error($exception->errorMessage());

            return 0;
        }
    }

    public function received(bool $is_seen = false): array
    {
        $messages = Facade::Receive($this->from, $is_seen);
        $items = [];
        foreach($messages as $message)
        {
            $items[] = (new Message())
                ->messageId($message->messageid)
                ->message($message->message)
                ->sender($message->sender)
                ->receptor($message->receptor)
                ->isSend(true)
                ->dateAt(Carbon::createFromTimestamp($message->date));
        }

        return $items;
    }
}
