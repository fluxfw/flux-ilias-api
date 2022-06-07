<?php

namespace FluxIliasApi\Adapter\UserRole;

class UserRoleDto
{

    public ?int $role_id;
    public ?string $role_import_id;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?int $role_id,
        /*public readonly*/ ?string $role_import_id
    ) {
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->role_id = $role_id;
        $this->role_import_id = $role_import_id;
    }


    public static function new(
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $role_id = null,
        ?string $role_import_id = null
    ) : /*static*/ self
    {
        return new static(
            $user_id,
            $user_import_id,
            $role_id,
            $role_import_id
        );
    }
}
