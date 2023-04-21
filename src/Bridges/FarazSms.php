<?php

namespace Amirmahvari\SmsMessage\Bridges;

use Amirmahvari\SmsMessage\SmsMessage;
use Exception;
use Illuminate\Support\Facades\Log;
use IPPanel\Client;

class FarazSms extends SmsMessage
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
        $client = new Client($this->api);
        try
        {
            if($this->template)
            {
                return $client->sendPattern($this->template ,
                    $this->from ,
                    $this->to ,
                    array_map(fn($item) => (string)$item , $this->parameters));
            }
            else
            {
                $to = is_array($this->to ) ? $this->to  : [$this->to];
                return $client->send($this->from ,
                    $to ,
                    join("\n" , $this->lines));
            }
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return false;
        }
    }

    public function credit():float
    {
        try{
            $client = new Client($this->api);
            return $client->getCredit() / 10;
        }catch(Exception $exception){
            return 0;
        }
    }
}
