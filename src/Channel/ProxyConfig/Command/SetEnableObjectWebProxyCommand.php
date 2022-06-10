<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetEnableObjectWebProxyCommand
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


    public function setEnableObjectWebProxy(bool $enable_object_web_proxy) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::ENABLE_OBJECT_WEB_PROXY(),
            $enable_object_web_proxy
        );
    }
}
