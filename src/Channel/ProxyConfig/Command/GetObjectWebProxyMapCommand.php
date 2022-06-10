<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class GetObjectWebProxyMapCommand
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
     * @return ObjectWebProxyMapDto[]
     */
    public function getObjectWebProxyMap() : array
    {
        return array_map([ObjectWebProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            LegacyConfigKey::OBJECT_WEB_PROXY_MAP()
        ));
    }
}
