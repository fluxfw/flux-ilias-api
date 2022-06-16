<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectApiProxyMapCommand
{

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : static {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function getFluxIliasRestObjectApiProxyMap(FluxIliasRestObjectDto $object, int $user_id) : ?FluxIliasRestObjectApiProxyMapDto
    {
        if (!$this->flux_ilias_rest_object_service->hasAccessToFluxIliasRestObjectProxy(
            $object->ref_id,
            $user_id
        )
        ) {
            return null;
        }

        if ($object->api_proxy_map_key === null) {
            return null;
        }

        return $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMapByKey(
            $object->api_proxy_map_key
        );
    }
}
