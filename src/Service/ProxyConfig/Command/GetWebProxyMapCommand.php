<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetWebProxyMapCommand
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


    /**
     * @return WebProxyMapDto[]
     */
    public function getWebProxyMap() : array
    {
        return array_map([WebProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            LegacyConfigKey::WEB_PROXY_MAP()
        ));
    }
}
