<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Adapter\Change\ChangeDto;
use FluxIliasApi\Service\Change\ChangeQuery;
use ilDBInterface;

class GetChangesCommand
{

    use ChangeQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return ChangeDto[]
     */
    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : array
    {
        return array_map([$this, "mapChangeDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getChangeQuery(
            $from,
            $to,
            $after,
            $before
        ))));
    }
}
