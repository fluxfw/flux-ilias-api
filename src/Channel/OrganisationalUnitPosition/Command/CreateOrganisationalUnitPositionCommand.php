<?php

namespace FluxIliasApi\Channel\OrganisationalUnitPosition\Command;

use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;

class CreateOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function createOrganisationalUnitPosition(OrganisationalUnitPositionDiffDto $diff) : OrganisationalUnitPositionIdDto
    {
        $ilias_organisational_unit_position = $this->newIliasOrganisationalUnitPosition();

        $this->mapOrganisationalUnitPositionDiff(
            $diff,
            $ilias_organisational_unit_position
        );

        $ilias_organisational_unit_position->store();

        return OrganisationalUnitPositionIdDto::new(
            $ilias_organisational_unit_position->getId() ?: null
        );
    }
}
