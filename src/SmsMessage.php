<?php
namespace Amirmahvari\SmsMessage;

use Illuminate\Support\Facades\Http;
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
        $this->baseUrl = config('app_config.sms_setting.url');
        $this->api = config('app_config.sms_setting.api');
        $this->secret = config('app_config.sms_setting.secret');
        $this->from = config('app_config.sms_setting.number');
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
        $kind = Kind::findKey('sms_pattern' , $key)->first();
        $this->template = $kind->value2;
        $this->parameters = $parameters;
        $this->status($kind->is_active);
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
