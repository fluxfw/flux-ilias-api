<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use ilUtil;

class GetFluxIliasRestObjectWebTypeTitleCommand
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


    public function getFluxIliasRestObjectWebTypeTitle() : string
    {
        $type_title = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectTypeTitle();
        if ($type_title !== null) {
            return $type_title;
        }

        return "flux-ilias-rest-object";
    }
}
