<?php

namespace FluxIliasApi\Service\ObjectConfig\Port;

use FluxIliasApi\Service\ObjectConfig\Command\DeleteObjectConfigCommand;
use FluxIliasApi\Service\ObjectConfig\Command\DeleteObjectConfigsCommand;
use FluxIliasApi\Service\ObjectConfig\Command\GetObjectConfigCommand;
use FluxIliasApi\Service\ObjectConfig\Command\SetObjectConfigCommand;
use FluxIliasApi\Service\ObjectConfig\LegacyObjectConfigKey;
use ilDBInterface;

class ObjectConfigService
{

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


    public function deleteObjectConfig(int $id) : void
    {
        DeleteObjectConfigCommand::new()
            ->deleteObjectConfig(
                $id
            );
    }


    public function deleteObjectConfigs() : void
    {
        DeleteObjectConfigsCommand::new(
            $this->ilias_database
        )
            ->deleteObjectConfigs();
    }


    public function getObjectConfig(int $id, LegacyObjectConfigKey $key)/* : mixed*/
    {
        return GetObjectConfigCommand::new()
            ->getObjectConfig(
                $id,
                $key
            );
    }


    public function setObjectConfig(int $id, LegacyObjectConfigKey $key, /*mixed*/ $value) : void
    {
        SetObjectConfigCommand::new()
            ->setObjectConfig(
                $id,
                $key,
                $value
            );
    }
}
