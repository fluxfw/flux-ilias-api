<?php

namespace FluxIliasApi\Adapter\CourseMember;

class CourseMemberIdDto
{

    public ?int $course_id;
    public ?string $course_import_id;
    public ?int $course_ref_id;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $course_id,
        /*public readonly*/ ?string $course_import_id,
        /*public readonly*/ ?int $course_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id
    ) {
        $this->course_id = $course_id;
        $this->course_import_id = $course_import_id;
        $this->course_ref_id = $course_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
    }


    public static function new(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : static {
        return new static(
            $course_id,
            $course_import_id,
            $course_ref_id,
            $user_id,
            $user_import_id
        );
    }
}
