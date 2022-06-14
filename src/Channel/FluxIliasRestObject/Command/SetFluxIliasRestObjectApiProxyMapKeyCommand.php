<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Channel\ObjectConfig\Port\ObjectConfigService;
use ilUtil;

class SetFluxIliasRestObjectApiProxyMapKeyCommand
{

    private ObjectConfigService $object_config_service;


    private function __construct(
        /*private readonly*/ ObjectConfigService $object_config_service
    ) {
        $this->object_config_service = $object_config_service;
    }


    public static function new(
        ObjectConfigService $object_config_service
    ) : /*static*/ self
    {
        return new static(
            $object_config_service
        );
    }


    public function setFluxIliasRestObjectApiProxyMapKey(int $id, ?string $api_proxy_map_key) : void
    {
        $this->object_config_service->setObjectConfig(
            $id,
            LegacyObjectConfigKey::API_PROXY_MAP_KEY(),
            $api_proxy_map_key
        );
    }
}
