<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Channel\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;

class GetFluxIliasRestObjectConfigFormValuesCommand
{

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : /*static*/ self
    {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function getFluxIliasRestObjectConfigFormValues(FluxIliasRestObjectDto $object) : object
    {
        return (object) [
            LegacyObjectConfigKey::API_PROXY_MAP_KEY()->value => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMapSelection(
                $object
            ),
            "description"                                     => $object->description,
            LegacyObjectConfigKey::WEB_PROXY_MAP_KEY()->value => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapSelection(
                $object
            ),
            "title"                                           => $object->title
        ];
    }
}
