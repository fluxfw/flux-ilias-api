<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetEnableLogChangesCommand
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


    public function setEnableLogChanges(bool $enable_log_changes) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::ENABLE_LOG_CHANGES(),
            $enable_log_changes
        );
    }
}
