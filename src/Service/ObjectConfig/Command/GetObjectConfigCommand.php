<?php

namespace FluxIliasApi\Service\ObjectConfig\Command;

use FluxIliasApi\Service\Config\ConfigQuery;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class GetObjectConfigCommand
{

    use ConfigQuery;
    use ObjectConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getObjectConfig(int $id, ObjectConfigKey $key) : mixed
    {
        return $this->getValueFromJson(
            ilContainer::_lookupContainerSetting($id, $this->getObjectConfigContainerSettingsPrefix() . $key->value, null)
        );
    }
}
