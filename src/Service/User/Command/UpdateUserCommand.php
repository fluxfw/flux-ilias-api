<?php

namespace FluxIliasApi\Service\User\Command;

use FluxIliasApi\Adapter\User\UserDiffDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Adapter\User\UserIdDto;
use FluxIliasApi\Service\Object\Port\ObjectService;
use FluxIliasApi\Service\User\Port\UserService;
use FluxIliasApi\Service\User\UserQuery;

class UpdateUserCommand
{

    use UserQuery;

    private ObjectService $object_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->user_service = $user_service;
        $this->object_service = $object_service;
    }


    public static function new(
        UserService $user_service,
        ObjectService $object_service
    ) : static {
        return new static(
            $user_service,
            $object_service
        );
    }


    public function updateUserById(int $id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user_service->getUserById(
                $id
            ),
            $diff
        );
    }


    public function updateUserByImportId(string $import_id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $diff
        );
    }


    private function updateUser(?UserDto $user, UserDiffDto $diff) : ?UserIdDto
    {
        if ($user === null) {
            return null;
        }

        $ilias_user = $this->getIliasUser(
            $user->id
        );
        if ($ilias_user === null) {
            return null;
        }

        $this->mapUserDiff(
            $diff,
            $ilias_user
        );

        $ilias_user->update();

        return UserIdDto::new(
            $user->id,
            $diff->import_id ?? $user->import_id
        );
    }
}
