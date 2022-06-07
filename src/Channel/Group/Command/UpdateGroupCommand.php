<?php

namespace FluxIliasApi\Channel\Group\Command;

use FluxIliasApi\Adapter\Group\GroupDiffDto;
use FluxIliasApi\Adapter\Group\GroupDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Channel\CustomMetadata\CustomMetadataQuery;
use FluxIliasApi\Channel\Group\GroupQuery;
use FluxIliasApi\Channel\Group\Port\GroupService;
use ilDBInterface;

class UpdateGroupCommand
{

    use CustomMetadataQuery;
    use GroupQuery;

    private GroupService $group_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ GroupService $group_service,
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->group_service = $group_service;
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        GroupService $group_service,
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $group_service,
            $ilias_database
        );
    }


    public function updateGroupById(int $id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateGroupByImportId(string $import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateGroupByRefId(int $ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateGroup(?GroupDto $group, GroupDiffDto $diff) : ?ObjectIdDto
    {
        if ($group === null) {
            return null;
        }

        $ilias_group = $this->getIliasGroup(
            $group->id,
            $group->ref_id
        );
        if ($ilias_group === null) {
            return null;
        }

        $this->mapGroupDiff(
            $diff,
            $ilias_group
        );

        $ilias_group->update();

        return ObjectIdDto::new(
            $group->id,
            $diff->import_id ?? $group->import_id,
            $group->ref_id
        );
    }
}
