<?php

namespace FluxIliasApi\Adapter\UserRole;

class UserRoleDto
{

    private function __construct(
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?int $role_id,
        public readonly ?string $role_import_id
    ) {

    }


    public static function new(
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $role_id = null,
        ?string $role_import_id = null
    ) : static {
        return new static(
            $user_id,
            $user_import_id,
            $role_id,
            $role_import_id
        );
    }
}
