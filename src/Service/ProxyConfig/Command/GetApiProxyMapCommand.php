<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetApiProxyMapCommand
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    /**
     * @return ApiProxyMapDto[]
     */
    public function getApiProxyMap() : array
    {
        return array_map([ApiProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            ConfigKey::API_PROXY_MAP
        ));
    }
}
