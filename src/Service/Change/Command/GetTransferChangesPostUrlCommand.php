<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetTransferChangesPostUrlCommand
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


    public function getTransferChangesPostUrl() : string
    {
        return strval($this->config_service->getConfig(
            ConfigKey::TRANSFER_CHANGES_POST_URL
        ));
    }
}
