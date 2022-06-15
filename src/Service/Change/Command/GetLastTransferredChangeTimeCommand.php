<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetLastTransferredChangeTimeCommand
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


    public function getLastTransferredChangeTime() : ?float
    {
        return $this->config_service->getConfig(
            LegacyConfigKey::LAST_TRANSFERRED_CHANGE_TIME()
        );
    }
}
