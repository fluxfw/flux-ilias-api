<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class IsEnableObjectWebProxyCommand
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


    public function isEnableObjectWebProxy() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_OBJECT_WEB_PROXY()
        ));
    }
}
