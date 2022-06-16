<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectWebProxyMapCommand
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


    public function getFluxIliasRestObjectWebProxyMap(FluxIliasRestObjectDto $object, int $user_id) : ?FluxIliasRestObjectWebProxyMapDto
    {
        if (!$this->flux_ilias_rest_object_service->hasAccessToFluxIliasRestObjectProxy(
            $object->ref_id,
            $user_id
        )
        ) {
            return null;
        }

        if ($object->web_proxy_map_key === null) {
            return null;
        }

        return $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapByKey(
            $object->web_proxy_map_key
        );
    }
}
