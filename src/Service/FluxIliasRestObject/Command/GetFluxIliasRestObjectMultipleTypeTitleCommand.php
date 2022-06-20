<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectMultipleTypeTitleCommand
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


    public function getFluxIliasRestObjectMultipleTypeTitle() : ?string
    {
        return $this->config_service->getConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE
        );
    }
}
