<?php

namespace FluxIliasApi\Service\ObjectConfig\Command;

use FluxIliasApi\Service\Config\ConfigQuery;
use FluxIliasApi\Service\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
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
