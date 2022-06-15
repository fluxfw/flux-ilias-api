<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetWebProxyMapCommand
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
     * @param WebProxyMapDto[] $web_proxy_map
     */
    public function setWebProxyMap(array $web_proxy_map) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::WEB_PROXY_MAP(),
            $web_proxy_map
        );
    }
}
