<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectWebProxyMapSelectionCommand
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


    public function getFluxIliasRestObjectWebProxyMapSelection(FluxIliasRestObjectDto $object) : object
    {
        return (object) [
            "value"  => $object->web_proxy_map_key,
            "values" => array_map(fn(FluxIliasRestObjectWebProxyMapDto $web_proxy_map) : string => $web_proxy_map->key,
                $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMaps())
        ];
    }
}
