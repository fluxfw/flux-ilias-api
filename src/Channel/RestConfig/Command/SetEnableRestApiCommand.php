<?php

namespace FluxIliasApi\Channel\RestConfig\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

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
    ) : /*static*/ self
    {
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
