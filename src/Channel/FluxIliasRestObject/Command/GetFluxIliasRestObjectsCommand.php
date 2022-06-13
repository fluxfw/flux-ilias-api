<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasApi\Channel\Object\ObjectQuery;
use FluxIliasApi\Channel\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;

class GetFluxIliasRestObjectsCommand
{

    use ConfigQuery;
    use FluxIliasRestObjectQuery;
    use ObjectConfigQuery;
    use ObjectQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
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
