<?php

namespace FluxIliasApi\Service\ObjectConfig\Command;

use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;

class DeleteObjectConfigsCommand
{

    use ObjectConfigQuery;

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


    public function deleteObjectConfigs() : void
    {
        $this->ilias_database->manipulate($this->getDeleteObjectConfigsQuery());
    }
}
