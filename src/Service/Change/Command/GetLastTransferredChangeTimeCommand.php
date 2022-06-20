<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetLastTransferredChangeTimeCommand
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


    public function getLastTransferredChangeTime() : ?float
    {
        return $this->config_service->getConfig(
            ConfigKey::LAST_TRANSFERRED_CHANGE_TIME
        );
    }
}
