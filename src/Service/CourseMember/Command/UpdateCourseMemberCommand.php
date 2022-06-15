<?php

namespace FluxIliasApi\Service\CourseMember\Command;

use FluxIliasApi\Adapter\Course\CourseDto;
use FluxIliasApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Service\Course\CourseQuery;
use FluxIliasApi\Service\Course\Port\CourseService;
use FluxIliasApi\Service\CourseMember\CourseMemberQuery;
use FluxIliasApi\Service\User\Port\UserService;

class UpdateCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private CourseService $course_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ CourseService $course_service,
        /*private readonly*/ UserService $user_service
    ) {
        $this->course_service = $course_service;
        $this->user_service = $user_service;
    }


    public static function new(
        CourseService $course_service,
        UserService $user_service
    ) : /*static*/ self
    {
        return new static(
            $course_service,
            $user_service
        );
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    private function updateCourseMember(?CourseDto $course, ?UserDto $user, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        if ($course === null || $user === null) {
            return null;
        }

        $ilias_course = $this->getIliasCourse(
            $course->id,
            $course->ref_id
        );
        if ($ilias_course === null) {
            return null;
        }

        if (!$ilias_course->getMembersObject()->isAssigned($user->id)) {
            return null;
        }

        $this->mapCourseMemberDiff(
            $diff,
            $user->id,
            $ilias_course
        );

        return CourseMemberIdDto::new(
            $course->id,
            $course->import_id,
            $course->ref_id,
            $user->id,
            $user->import_id
        );
    }
}
