<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Service\ObjectConfig\LegacyObjectConfigKey;

class StoreFluxIliasRestObjectConfigFormValuesCommand
{

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : static {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function storeFluxIliasRestObjectConfigFormValues(FluxIliasRestObjectDto $object, object $values) : bool
    {
        $this->flux_ilias_rest_object_service->updateFluxIliasRestObjectById(
            $object->id,
            FluxIliasRestObjectDiffDto::new(
                null,
                strval($values->title ?? null),
                strval($values->description ?? null),
                strval($values->{LegacyObjectConfigKey::WEB_PROXY_MAP_KEY()->value} ?? null),
                strval($values->{LegacyObjectConfigKey::API_PROXY_MAP_KEY()->value} ?? null)
            )
        );

        return true;
    }
}
