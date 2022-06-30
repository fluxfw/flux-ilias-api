<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Permission\DefaultPermission;
use FluxIliasApi\Service\Object\Port\ObjectService;

class HasAccessToFluxIliasRestObjectConfigFormCommand
{

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    public function hasAccessToFluxIliasRestObjectConfigForm(int $ref_id, int $user_id) : bool
    {
        return $this->object_service->hasAccessInObject(
            $ref_id,
            $user_id,
            DefaultPermission::EDIT_SETTINGS
        );
    }
}
