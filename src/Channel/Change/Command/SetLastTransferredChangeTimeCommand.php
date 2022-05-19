<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetLastTransferredChangeTimeCommand
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


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::LAST_TRANSFERRED_CHANGE_TIME(),
            $last_transferred_change_time
        );
    }
}
