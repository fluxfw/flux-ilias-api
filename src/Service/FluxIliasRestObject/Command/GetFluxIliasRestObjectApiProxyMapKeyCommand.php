<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Service\ObjectConfig\Port\ObjectConfigService;
use ilUtil;

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
            LegacyObjectConfigKey::API_PROXY_MAP_KEY()
        );
    }
}
