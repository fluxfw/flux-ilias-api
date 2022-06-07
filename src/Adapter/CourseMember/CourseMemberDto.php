<?php

namespace FluxIliasApi\Adapter\CourseMember;

use FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;

class CourseMemberDto
{

    public ?bool $access_refused;
    public ?bool $administrator_role;
    public ?int $course_id;
    public ?string $course_import_id;
    public ?int $course_ref_id;
    public ?LegacyObjectLearningProgress $learning_progress;
    public ?bool $member_role;
    public ?bool $notification;
    public ?bool $passed;
    public ?bool $tutor_role;
    public ?bool $tutorial_support;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $course_id,
        /*public readonly*/ ?string $course_import_id,
        /*public readonly*/ ?int $course_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $tutor_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $passed,
        /*public readonly*/ ?bool $access_refused,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
        $this->course_id = $course_id;
        $this->course_import_id = $course_import_id;
        $this->course_ref_id = $course_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->member_role = $member_role;
        $this->tutor_role = $tutor_role;
        $this->administrator_role = $administrator_role;
        $this->learning_progress = $learning_progress;
        $this->passed = $passed;
        $this->access_refused = $access_refused;
        $this->tutorial_support = $tutorial_support;
        $this->notification = $notification;
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
        ?LegacyObjectLearningProgress $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
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
