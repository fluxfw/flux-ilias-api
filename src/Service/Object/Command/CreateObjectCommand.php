<?php

namespace FluxIliasApi\Service\Object\Command;

use FluxIliasApi\Adapter\Object\ObjectDiffDto;
use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Adapter\Object\ObjectType;
use FluxIliasApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasApi\Service\Object\ObjectQuery;
use FluxIliasApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class CreateObjectCommand
{

    use CustomMetadataQuery;
    use ObjectQuery;

    private ilDBInterface $ilias_database;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->object_service = $object_service;
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $object_service,
            $ilias_database
        );
    }


    public function createObjectToId(ObjectType $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createObjectToImportId(ObjectType $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createObjectToRefId(ObjectType $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $diff
        );
    }


    private function createObject(ObjectType $type, ?ObjectDto $parent_object, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        $ilias_object = $this->newIliasObject(
            $type
        );

        $ilias_object->setTitle($diff->title ?? "");

        $ilias_object->create();
        $ilias_object->createReference();
        $ilias_object->putInTree($parent_object->ref_id);
        $ilias_object->setPermissions($parent_object->ref_id);

        $this->mapObjectDiff(
            $diff,
            $ilias_object
        );

        $ilias_object->update();

        return ObjectIdDto::new(
            $ilias_object->getId() ?: null,
            $diff->import_id,
            $ilias_object->getRefId() ?: null
        );
    }
}
