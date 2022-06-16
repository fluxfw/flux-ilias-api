<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectApiProxyMapsCommand
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
     * @return FluxIliasRestObjectApiProxyMapDto[]
     */
    public function getFluxIliasRestObjectApiProxyMaps() : array
    {
        return array_map([FluxIliasRestObjectApiProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS()
        ));
    }
}
