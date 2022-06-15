<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectWebProxyMapsCommand
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
     * @return FluxIliasRestObjectWebProxyMapDto[]
     */
    public function getFluxIliasRestObjectWebProxyMaps() : array
    {
        return array_map([FluxIliasRestObjectWebProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS()
        ));
    }
}
