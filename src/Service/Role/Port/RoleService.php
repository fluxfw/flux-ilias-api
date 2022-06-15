<?php

namespace FluxIliasApi\Service\Role\Port;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Adapter\Role\RoleDiffDto;
use FluxIliasApi\Adapter\Role\RoleDto;
use FluxIliasApi\Service\Object\Port\ObjectService;
use FluxIliasApi\Service\Role\Command\CreateRoleCommand;
use FluxIliasApi\Service\Role\Command\GetGlobalRoleObjectCommand;
use FluxIliasApi\Service\Role\Command\GetRoleCommand;
use FluxIliasApi\Service\Role\Command\GetRolesCommand;
use FluxIliasApi\Service\Role\Command\UpdateRoleCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class RoleService
{

    private ilDBInterface $ilias_database;
    private RBACServices $ilias_rbac;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ RBACServices $ilias_rbac
    ) {
        $this->ilias_database = $ilias_database;
        $this->object_service = $object_service;
        $this->ilias_rbac = $ilias_rbac;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service,
        RBACServices $ilias_rbac
    ) : static {
        return new static(
            $ilias_database,
            $object_service,
            $ilias_rbac
        );
    }


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToId(
                $object_id,
                $diff
            );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToImportId(
                $object_import_id,
                $diff
            );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToRefId(
                $object_ref_id,
                $diff
            );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return GetGlobalRoleObjectCommand::new(
            $this->object_service
        )
            ->getGlobalRoleObject();
    }


    public function getRoleById(int $id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->ilias_database
        )
            ->getRoleById(
                $id
            );
    }


    public function getRoleByImportId(string $import_id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->ilias_database
        )
            ->getRoleByImportId(
                $import_id
            );
    }


    /**
     * @return RoleDto[]
     */
    public function getRoles() : array
    {
        return GetRolesCommand::new(
            $this->ilias_database
        )
            ->getRoles();
    }


    public function updateRoleById(int $id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateRoleCommand::new(
            $this
        )
            ->updateRoleById(
                $id,
                $diff
            );
    }


    public function updateRoleByImportId(string $import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateRoleCommand::new(
            $this
        )
            ->updateRoleByImportId(
                $import_id,
                $diff
            );
    }
}
