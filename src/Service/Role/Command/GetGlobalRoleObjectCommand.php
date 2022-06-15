<?php

namespace FluxIliasApi\Service\Role\Command;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Service\Object\Port\ObjectService;

class GetGlobalRoleObjectCommand
{

    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->object_service = $object_service;
    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return $this->object_service->getObjectByRefId(
            ROLE_FOLDER_ID
        );
    }
}
