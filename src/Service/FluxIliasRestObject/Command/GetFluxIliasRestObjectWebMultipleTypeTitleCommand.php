<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use ilUtil;

class GetFluxIliasRestObjectWebMultipleTypeTitleCommand
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


    public function getFluxIliasRestObjectWebMultipleTypeTitle() : string
    {
        $multiple_type_title = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectMultipleTypeTitle();
        if ($multiple_type_title !== null) {
            return $multiple_type_title;
        }

        return "flux-ilias-rest-objects";
    }
}
