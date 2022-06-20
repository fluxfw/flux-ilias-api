<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectWebProxyMapsCommand
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
     * @return FluxIliasRestObjectWebProxyMapDto[]
     */
    public function getFluxIliasRestObjectWebProxyMaps() : array
    {
        return array_map([FluxIliasRestObjectWebProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS
        ));
    }
}
