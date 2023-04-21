<?php
namespace Amirmahvari\SmsMessage;

use App\Models\Kind;

abstract class SmsMessage
{
    protected $api;
    protected $secret;
    protected $to;
    protected $from;
    protected $lines;
    protected $template=false;
    protected bool $is_enable=true;
    protected $parameters;

    /**
     * SmsMessage constructor.
     * @param array $lines
     */
    public function __construct($lines = []) {
        $this->lines = $lines;
        $this->baseUrl = config('sms_message.url');
        $this->api = config('sms_message.api');
        $this->secret = config('sms_message.secret');
        $this->from = config('sms_message.number');
    }

    public function line($line = ''): self {
        $this->lines[] = $line;
        return $this;
    }

    public function to($to): self {
        $this->to = $to;
        return $this;
    }

    public function from($from): self {
        $this->from = $from;
        return $this;
    }

    public function template($template,$parameters=[]): self {
        $this->template = $template;
        $this->parameters = $parameters;
        return $this;
    }

    public function pattern(string $key,$parameters=[]): self {
        $pattern = config("sms_message.patterns.$key");
        $this->template = $pattern['template'];
        $this->parameters = $parameters;
        $this->status($pattern['is_active']);
        return $this;
    }

    /**
     * @param bool $is_enable
     */
    public function status(bool $is_enable): self
    {
        $this->is_enable = $is_enable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->is_enable;
    }

    abstract public function send();

    abstract public function credit():float;

    public function dryrun($dry = 'yes'): self {
        $this->dryrun = $dry;
        return $this;
    }
}
