<?php

namespace FluxIliasApi\Channel\Object\Command;

use FluxIliasApi\Adapter\Object\ObjectDiffDto;
use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Channel\CustomMetadata\CustomMetadataQuery;
use FluxIliasApi\Channel\Object\ObjectQuery;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class UpdateObjectCommand
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


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateObject(?ObjectDto $object, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null) {
            return null;
        }

        $ilias_object = $this->getIliasObject(
            $object->getId(),
            $object->getRefId()
        );
        if ($ilias_object === null) {
            return null;
        }

        $this->mapObjectDiff(
            $diff,
            $ilias_object
        );

        $ilias_object->update();

        return ObjectIdDto::new(
            $object->getId(),
            $diff->getImportId() ?? $object->getImportId(),
            $object->getRefId()
        );
    }
}
