<?php

namespace FluxIliasApi\Channel\ObjectConfig\Command;

use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Channel\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class SetObjectConfigCommand
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


    public function setObjectConfig(int $id, LegacyObjectConfigKey $key, /*mixed*/ $value) : void
    {
        ilContainer::_writeContainerSetting($id, $this->getObjectConfigContainerSettingsPrefix() . $key->value, $this->getValueAsJson(
            $value
        ));
    }
}
