<?php

namespace FluxIliasApi\Adapter\CourseMember;

use FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;

class CourseMemberDiffDto
{

    public ?bool $access_refused;
    public ?bool $administrator_role;
    public ?LegacyObjectLearningProgress $learning_progress;
    public ?bool $member_role;
    public ?bool $notification;
    public ?bool $passed;
    public ?bool $tutor_role;
    public ?bool $tutorial_support;


    private function __construct(
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $tutor_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $passed,
        /*public readonly*/ ?bool $access_refused,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
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


    public static function newFromObject(
        object $diff
    ) : /*static*/ self
    {
        return static::new(
            $diff->member_role ?? null,
            $diff->tutor_role ?? null,
            $diff->administrator_role ?? null,
            ($learning_progress = $diff->learning_progress ?? null) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null,
            $diff->passed ?? null,
            $diff->access_refused ?? null,
            $diff->tutorial_support ?? null,
            $diff->notification ?? null
        );
    }
}
