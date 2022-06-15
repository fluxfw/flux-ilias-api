<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Change\ChangeQuery;
use FluxIliasApi\Service\Change\Port\ChangeService;
use ilDBInterface;

class PurgeChangesCommand
{

    use ChangeQuery;

    private ChangeService $change_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->change_service = $change_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : static {
        return new static(
            $ilias_database,
            $change_service
        );
    }


    public function purgeChanges() : int
    {
        return $this->ilias_database->manipulate($this->getChangePurgeQuery(
            $this->change_service->getKeepChangesInsideDays()
        ));
    }
}
