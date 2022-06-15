<?php

namespace FluxIliasApi\Service\Group\Command;

use FluxIliasApi\Adapter\Group\GroupDto;
use FluxIliasApi\Service\Group\GroupQuery;
use FluxIliasApi\Service\Object\ObjectQuery;
use ilDBInterface;

class GetGroupsCommand
{

    use GroupQuery;
    use ObjectQuery;

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
     * @return GroupDto[]
     */
    public function getGroups(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapGroupDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getGroupQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
