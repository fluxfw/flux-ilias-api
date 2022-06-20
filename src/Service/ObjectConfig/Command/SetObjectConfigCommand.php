<?php

namespace FluxIliasApi\Service\ObjectConfig\Command;

use FluxIliasApi\Service\Config\ConfigQuery;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class SetObjectConfigCommand
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


    public function setObjectConfig(int $id, ObjectConfigKey $key, mixed $value) : void
    {
        ilContainer::_writeContainerSetting($id, $this->getObjectConfigContainerSettingsPrefix() . $key->value, $this->getValueAsJson(
            $value
        ));
    }
}
