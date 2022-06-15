<?php

namespace FluxIliasApi\Service\RestConfig\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class IsEnableRestApiCommand
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


    public function isEnableRestApi() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_REST_API()
        ));
    }
}
