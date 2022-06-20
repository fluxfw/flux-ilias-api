<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetFluxIliasRestObjectDefaultIconUrlCommand
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


    public function setFluxIliasRestObjectDefaultIconUrl(?string $default_icon_url) : void
    {
        $this->config_service->setConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL,
            $default_icon_url
        );
    }
}
