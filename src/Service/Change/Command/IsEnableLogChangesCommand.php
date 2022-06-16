<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class IsEnableLogChangesCommand
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


    public function isEnableLogChanges() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_LOG_CHANGES()
        ));
    }
}
