<?php

namespace FluxIliasApi\Service\Course\Port;

use FluxIliasApi\Adapter\Course\CourseDiffDto;
use FluxIliasApi\Adapter\Course\CourseDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Service\Course\Command\CreateCourseCommand;
use FluxIliasApi\Service\Course\Command\GetCourseCommand;
use FluxIliasApi\Service\Course\Command\GetCoursesCommand;
use FluxIliasApi\Service\Course\Command\UpdateCourseCommand;
use FluxIliasApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class CourseService
{

    private ilDBInterface $ilias_database;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->object_service = $object_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $object_service
        );
    }


    public function createCourseToId(int $parent_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createCourseToId(
                $parent_id,
                $diff
            );
    }


    public function createCourseToImportId(string $parent_import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createCourseToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCourseToRefId(int $parent_ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createCourseToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getCourseById(int $id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseById(
                $id,
                $in_trash
            );
    }


    public function getCourseByImportId(string $import_id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCourseByRefId(int $ref_id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseByRefId(
                $ref_id,
                $in_trash
            );
    }


    /**
     * @return CourseDto[]
     */
    public function getCourses(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        return GetCoursesCommand::new(
            $this->ilias_database
        )
            ->getCourses(
                $container_settings,
                $in_trash
            );
    }


    public function updateCourseById(int $id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateCourseById(
                $id,
                $diff
            );
    }


    public function updateCourseByImportId(string $import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateCourseByImportId(
                $import_id,
                $diff
            );
    }


    public function updateCourseByRefId(int $ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateCourseByRefId(
                $ref_id,
                $diff
            );
    }
}
