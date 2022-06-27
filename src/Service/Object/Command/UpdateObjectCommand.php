<?php

namespace FluxIliasApi\Service\Object\Command;

use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDiffDto;
use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasApi\Service\Object\ObjectQuery;
use FluxIliasApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class UpdateObjectCommand
{

    use CustomMetadataQuery;
    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : static {
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
            $object->id,
            $object->ref_id
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
            $object->id,
            $diff->import_id ?? $object->import_id,
            $object->ref_id
        );
    }
}
