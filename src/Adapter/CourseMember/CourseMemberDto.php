<?php

namespace FluxIliasApi\Adapter\CourseMember;

use FluxIliasApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;

class CourseMemberDto
{

    private function __construct(
        public readonly ?int $course_id,
        public readonly ?string $course_import_id,
        public readonly ?int $course_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?bool $member_role,
        public readonly ?bool $tutor_role,
        public readonly ?bool $administrator_role,
        public readonly ?ObjectLearningProgress $learning_progress,
        public readonly ?bool $passed,
        public readonly ?bool $access_refused,
        public readonly ?bool $tutorial_support,
        public readonly ?bool $notification
    ) {

    }


    public static function new(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?ObjectLearningProgress $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : static {
        return new static(
            $course_id,
            $course_import_id,
            $course_ref_id,
            $user_id,
            $user_import_id,
            $member_role,
            $tutor_role,
            $administrator_role,
            $learning_progress,
            $passed,
            $access_refused,
            $tutorial_support,
            $notification
        );
    }
}
