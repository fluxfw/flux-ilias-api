<?php

namespace FluxIliasApi\Channel\User\Command;

use FluxIliasApi\Adapter\User\UserDiffDto;
use FluxIliasApi\Adapter\User\UserIdDto;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\User\UserQuery;
use ILIAS\DI\RBACServices;

class CreateUserCommand
{

    use UserQuery;

    private RBACServices $ilias_rbac;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ RBACServices $ilias_rbac,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_rbac = $ilias_rbac;
        $this->object_service = $object_service;
    }


    public static function new(
        RBACServices $ilias_rbac,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_rbac,
            $object_service
        );
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        $ilias_user = $this->newIliasUser();

        $ilias_user->setActive(true);
        $ilias_user->setTimeLimitUnlimited(true);

        $this->mapUserDiff(
            $diff,
            $ilias_user
        );

        $ilias_user->create();
        $ilias_user->saveAsNew();

        $this->ilias_rbac->admin()->assignUser(4, $ilias_user->getId());

        return UserIdDto::new(
            $ilias_user->getId() ?: null,
            $diff->import_id
        );
    }
}
