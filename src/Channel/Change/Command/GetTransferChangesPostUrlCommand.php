<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class GetTransferChangesPostUrlCommand
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


    public function getTransferChangesPostUrl() : string
    {
        return strval($this->config_service->getConfig(
            LegacyConfigKey::TRANSFER_CHANGES_POST_URL()
        ));
    }
}
