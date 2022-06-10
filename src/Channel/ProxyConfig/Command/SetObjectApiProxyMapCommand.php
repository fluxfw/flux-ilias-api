<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectApiProxyMapDto;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetObjectApiProxyMapCommand
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
     * @param ObjectApiProxyMapDto[] $object_api_proxy_map
     */
    public function setObjectApiProxyMap(array $object_api_proxy_map) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::OBJECT_API_PROXY_MAP(),
            $object_api_proxy_map
        );
    }
}
