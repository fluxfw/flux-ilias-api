<?php

namespace FluxIliasApi\Adapter\GroupMember;

class GroupMemberIdDto
{

    public ?int $group_id;
    public ?string $group_import_id;
    public ?int $group_ref_id;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $group_id,
        /*public readonly*/ ?string $group_import_id,
        /*public readonly*/ ?int $group_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id
    ) {
        $this->group_id = $group_id;
        $this->group_import_id = $group_import_id;
        $this->group_ref_id = $group_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
    }


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : static {
        return new static(
            $group_id,
            $group_import_id,
            $group_ref_id,
            $user_id,
            $user_import_id
        );
    }
}
