<?php

namespace FluxIliasApi\Service\Config\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\ConfigQuery;
use ilSetting;

class SetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function setConfig(ConfigKey $key, mixed $value) : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->set($key->value, $this->getValueAsJson(
            $value
        ));
    }
}
