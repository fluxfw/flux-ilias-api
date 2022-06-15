<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Service\Config\ConfigQuery;
use FluxIliasApi\Service\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Service\Object\ObjectQuery;
use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;

class GetFluxIliasRestObjectsCommand
{

    use ConfigQuery;
    use FluxIliasRestObjectQuery;
    use ObjectConfigQuery;
    use ObjectQuery;

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
    ) : static {
        return new static(
            $flux_ilias_rest_object_service,
            $ilias_database
        );
    }


    /**
     * @return FluxIliasRestObjectDto[]
     */
    public function getFluxIliasRestObjects(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectQuery(
            null,
            null,
            null,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $container_settings_ = $container_settings ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery($object_ids)))
            : null;

        return array_map(fn(array $object) : FluxIliasRestObjectDto => $this->mapFluxIliasRestObjectDto(
            $object,
            $container_settings_
        ), $objects);
    }
}
