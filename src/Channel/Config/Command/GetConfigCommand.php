<?php

namespace FluxIliasApi\Channel\Config\Command;

use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use ilSetting;

class GetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function getConfig(LegacyConfigKey $key)/* : mixed*/
    {
        $value = (new ilSetting($this->getConfigSettingsModule()))->get($key->value, null);

        if ($value === null) {
            return null;
        }

        return json_decode($value);
    }
}
