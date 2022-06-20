<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetLastTransferredChangeTimeCommand
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        $this->config_service->setConfig(
            ConfigKey::LAST_TRANSFERRED_CHANGE_TIME,
            $last_transferred_change_time
        );
    }
}
