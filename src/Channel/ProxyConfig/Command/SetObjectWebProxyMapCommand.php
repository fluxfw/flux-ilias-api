<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetObjectWebProxyMapCommand
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


    /**
     * @param ObjectWebProxyMapDto[] $object_web_proxy_map
     */
    public function setObjectWebProxyMap(array $object_web_proxy_map) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::OBJECT_WEB_PROXY_MAP(),
            $object_web_proxy_map
        );
    }
}
