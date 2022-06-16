<?php

namespace FluxIliasApi\Adapter\GroupMember;

use FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;

class GroupMemberDto
{

    private function __construct(
        public readonly ?int $group_id,
        public readonly ?string $group_import_id,
        public readonly ?int $group_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?bool $member_role,
        public readonly ?bool $administrator_role,
        public readonly ?LegacyObjectLearningProgress $learning_progress,
        public readonly ?bool $tutorial_support,
        public readonly ?bool $notification
    ) {

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
    ) : static {
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
