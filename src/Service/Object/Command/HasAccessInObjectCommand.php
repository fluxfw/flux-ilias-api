<?php

namespace FluxIliasApi\Service\Object\Command;

use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Permission\Permission;
use FluxIliasApi\Service\Permission\PermissionMapping;
use ilAccessHandler;

class HasAccessInObjectCommand
{

    private function __construct(
        private readonly ilAccessHandler $ilias_access
    ) {

    }


    public static function new(
        ilAccessHandler $ilias_access
    ) : static {
        return new static(
            $ilias_access
        );
    }


    public function hasAccessInObject(int $ref_id, int $user_id, Permission $permission) : bool
    {
        return $this->ilias_access->checkAccessOfUser($user_id, PermissionMapping::mapExternalToInternal($permission)->value, "", $ref_id);
    }
}
