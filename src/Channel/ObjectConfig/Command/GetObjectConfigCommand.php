<?php

namespace FluxIliasApi\Channel\ObjectConfig\Command;

use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Channel\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class GetObjectConfigCommand
{

    use ConfigQuery;
    use ObjectConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function getObjectConfig(int $id, LegacyObjectConfigKey $key)/* : mixed*/
    {
        return $this->getValueFromJson(
            ilContainer::_lookupContainerSetting($id, $this->getObjectConfigContainerSettingsPrefix() . $key->value, null)
        );
    }
}
