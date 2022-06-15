<?php

namespace FluxIliasApi\Service\RestConfig\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetEnableRestApiCommand
{

    private ConfigService $config_service;


    private function __construct(
        /*private readonly*/ ConfigService $config_service
    ) {
        $this->config_service = $config_service;
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
            LegacyConfigKey::ENABLE_REST_API(),
            $enable_rest_api
        );
    }
}
