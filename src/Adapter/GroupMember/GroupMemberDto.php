<?php

namespace FluxIliasApi\Adapter\GroupMember;

use FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;

class GroupMemberDto
{

    public ?bool $administrator_role;
    public ?int $group_id;
    public ?string $group_import_id;
    public ?int $group_ref_id;
    public ?LegacyObjectLearningProgress $learning_progress;
    public ?bool $member_role;
    public ?bool $notification;
    public ?bool $tutorial_support;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $group_id,
        /*public readonly*/ ?string $group_import_id,
        /*public readonly*/ ?int $group_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
        $this->group_id = $group_id;
        $this->group_import_id = $group_import_id;
        $this->group_ref_id = $group_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->member_role = $member_role;
        $this->administrator_role = $administrator_role;
        $this->learning_progress = $learning_progress;
        $this->tutorial_support = $tutorial_support;
        $this->notification = $notification;
    }


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?LegacyObjectLearningProgress $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        return new static(
            $group_id,
            $group_import_id,
            $group_ref_id,
            $user_id,
            $user_import_id,
            $member_role,
            $administrator_role,
            $learning_progress,
            $tutorial_support,
            $notification
        );
    }
}
