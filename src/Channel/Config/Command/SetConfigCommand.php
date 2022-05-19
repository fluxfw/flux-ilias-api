<?php

namespace FluxIliasApi\Channel\Config\Command;

use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use ilSetting;

class SetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function setConfig(LegacyConfigKey $key, /*mixed*/ $value) : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->set($key->value, json_encode($value, JSON_UNESCAPED_SLASHES));
    }
}
