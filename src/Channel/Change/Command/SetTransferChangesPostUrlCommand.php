<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetTransferChangesPostUrlCommand
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


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::TRANSFER_CHANGES_POST_URL(),
            $transfer_changes_post_url
        );
    }
}
