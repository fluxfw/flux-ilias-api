<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class IsEnableLogChangesCommand
{

    private ConfigService $config_service;


    private function __construct(
        /*private readonly*/ ConfigService $config_service
    ) {
        $this->config_service = $config_service;
    }


    public static function new(
        ConfigService $config_service
    ) : /*static*/ self
    {
        return new static(
            $config_service
        );
    }


    public function isEnableLogChanges() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_LOG_CHANGES()
        ));
    }
}
