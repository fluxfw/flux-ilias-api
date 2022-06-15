<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectDefaultIconUrlCommand
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


    public function getFluxIliasRestObjectDefaultIconUrl() : ?string
    {
        return $this->config_service->getConfig(
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL()
        );
    }
}
