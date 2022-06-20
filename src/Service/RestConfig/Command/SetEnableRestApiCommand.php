<?php

namespace FluxIliasApi\Service\RestConfig\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetEnableRestApiCommand
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


    public function setEnableRestApi(bool $enable_rest_api) : void
    {
        $this->config_service->setConfig(
            ConfigKey::ENABLE_REST_API,
            $enable_rest_api
        );
    }
}
