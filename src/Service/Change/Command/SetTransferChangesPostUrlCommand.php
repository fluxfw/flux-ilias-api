<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetTransferChangesPostUrlCommand
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


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::TRANSFER_CHANGES_POST_URL(),
            $transfer_changes_post_url
        );
    }
}
