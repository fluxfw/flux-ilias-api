<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasApi\Service\ObjectConfig\Port\ObjectConfigService;

class GetFluxIliasRestObjectApiProxyMapKeyCommand
{

    private function __construct(
        private readonly ObjectConfigService $object_config_service
    ) {

    }


    public static function new(
        ObjectConfigService $object_config_service
    ) : static {
        return new static(
            $object_config_service
        );
    }


    public function getFluxIliasRestObjectApiProxyMapKey(int $id) : ?string
    {
        return $this->object_config_service->getObjectConfig(
            $id,
            ObjectConfigKey::API_PROXY_MAP_KEY
        );
    }
}
