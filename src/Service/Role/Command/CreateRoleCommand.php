<?php

namespace FluxIliasApi\Service\Role\Command;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Adapter\Role\RoleDiffDto;
use FluxIliasApi\Service\Object\Port\ObjectService;
use FluxIliasApi\Service\Role\RoleQuery;
use ILIAS\DI\RBACServices;

class CreateRoleCommand
{

    use RoleQuery;

    private RBACServices $ilias_rbac;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ RBACServices $ilias_rbac
    ) {
        $this->object_service = $object_service;
        $this->ilias_rbac = $ilias_rbac;
    }


    public static function new(
        ObjectService $object_service,
        RBACServices $ilias_rbac
    ) : /*static*/ self
    {
        return new static(
            $object_service,
            $ilias_rbac
        );
    }


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectById(
                $object_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectByRefId(
                $object_ref_id,
                false
            ),
            $diff
        );
    }


    private function createRole(?ObjectDto $object, RoleDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null || $object->ref_id === null) {
            return null;
        }

        $ilias_role = $this->newIliasRole();

        $ilias_role->setTitle($diff->title ?? "");

        $ilias_role->create();
        $this->ilias_rbac->admin()->assignRoleToFolder($ilias_role->getId(), $object->ref_id);

        $this->mapRoleDiff(
            $diff,
            $ilias_role
        );

        $ilias_role->update();

        return ObjectIdDto::new(
            $ilias_role->getId() ?: null,
            $diff->import_id
        );
    }
}
