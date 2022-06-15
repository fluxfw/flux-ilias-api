<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Service\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use ilDBInterface;

class UpdateFluxIliasRestObjectCommand
{

    use FluxIliasRestObjectQuery;

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service,
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $flux_ilias_rest_object_service,
            $ilias_database
        );
    }


    public function updateFluxIliasRestObjectById(int $id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateFluxIliasRestObjectByImportId(string $import_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateFluxIliasRestObjectByRefId(int $ref_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateFluxIliasRestObject(?FluxIliasRestObjectDto $object, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null) {
            return null;
        }

        $ilias_flux_ilias_rest_object = $this->getIliasFluxIliasRestObject(
            $object->id,
            $object->ref_id
        );
        if ($ilias_flux_ilias_rest_object === null) {
            return null;
        }

        $this->mapFluxIliasRestObjectDiff(
            $diff,
            $ilias_flux_ilias_rest_object
        );

        $ilias_flux_ilias_rest_object->update();

        return ObjectIdDto::new(
            $object->id,
            $diff->import_id ?? $object->import_id,
            $object->ref_id
        );
    }
}
