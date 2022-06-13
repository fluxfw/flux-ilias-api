<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Channel\Config\ConfigQuery;
use FluxIliasApi\Channel\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasApi\Channel\Object\ObjectQuery;
use FluxIliasApi\Channel\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;
use LogicException;

class GetFluxIliasRestObjectCommand
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


    public function getFluxIliasRestObjectById(int $id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                $id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the id " . $id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getFluxIliasRestObjectByImportId(string $import_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                null,
                $import_id,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the import id " . $import_id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getFluxIliasRestObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                null,
                null,
                $ref_id,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the ref id " . $ref_id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }
}
