<?php

namespace FluxIliasApi\Service\Config\Command;

use FluxIliasApi\Service\Config\ConfigQuery;
use FluxIliasApi\Service\Config\LegacyConfigKey;
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


    public function getConfig(LegacyConfigKey $key)/* : mixed*/
    {
        return $this->getValueFromJson(
            (new ilSetting($this->getConfigSettingsModule()))->get($key->value, null)
        );
    }
}
