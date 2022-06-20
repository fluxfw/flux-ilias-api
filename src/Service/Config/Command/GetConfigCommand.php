<?php

namespace FluxIliasApi\Service\Config\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\ConfigQuery;
use ilSetting;

class GetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getConfig(ConfigKey $key) : mixed
    {
        return $this->getValueFromJson(
            (new ilSetting($this->getConfigSettingsModule()))->get($key->value, null)
        );
    }
}
