<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class IsEnableApiProxyCommand
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


    public function isEnableApiProxy() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_API_PROXY()
        ));
    }
}