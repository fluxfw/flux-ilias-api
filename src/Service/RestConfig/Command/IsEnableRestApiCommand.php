<?php

namespace FluxIliasApi\Service\RestConfig\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class IsEnableRestApiCommand
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


    public function isEnableRestApi() : bool
    {
        return boolval($this->config_service->getConfig(
            ConfigKey::ENABLE_REST_API
        ));
    }
}
