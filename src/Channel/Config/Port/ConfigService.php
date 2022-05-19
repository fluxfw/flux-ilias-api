<?php

namespace FluxIliasApi\Channel\Config\Port;

use FluxIliasApi\Channel\Config\Command\DeleteConfigCommand;
use FluxIliasApi\Channel\Config\Command\GetConfigCommand;
use FluxIliasApi\Channel\Config\Command\SetConfigCommand;
use FluxIliasApi\Channel\Config\LegacyConfigKey;

class ConfigService
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function deleteConfig() : void
    {
        DeleteConfigCommand::new()
            ->deleteConfig();
    }


    public function getConfig(LegacyConfigKey $key)/* : mixed*/
    {
        return GetConfigCommand::new()
            ->getConfig(
                $key
            );
    }


    public function setConfig(LegacyConfigKey $key, /*mixed*/ $value) : void
    {
        SetConfigCommand::new()
            ->setConfig(
                $key,
                $value
            );
    }
}
