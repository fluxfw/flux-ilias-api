<?php

namespace FluxIliasApi\Channel\OrganisationalUnitPosition\Port;

use FluxIliasApi\Adapter\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasApi\Channel\OrganisationalUnitPosition\Command\CreateOrganisationalUnitPositionCommand;
use FluxIliasApi\Channel\OrganisationalUnitPosition\Command\DeleteOrganisationalUnitPositionCommand;
use FluxIliasApi\Channel\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionCommand;
use FluxIliasApi\Channel\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionsCommand;
use FluxIliasApi\Channel\OrganisationalUnitPosition\Command\UpdateOrganisationalUnitPositionCommand;
use ilDBInterface;

class OrganisationalUnitPositionService
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


    public function createOrganisationalUnitPosition(OrganisationalUnitPositionDiffDto $diff) : OrganisationalUnitPositionIdDto
    {
        return CreateOrganisationalUnitPositionCommand::new()
            ->createOrganisationalUnitPosition(
                $diff
            );
    }


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return DeleteOrganisationalUnitPositionCommand::new(
            $this
        )
            ->deleteOrganisationalUnitPositionById(
                $id
            );
    }


    public function getOrganisationalUnitPositionByCoreIdentifier(LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier) : ?OrganisationalUnitPositionDto
    {
        return GetOrganisationalUnitPositionCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositionByCoreIdentifier(
                $core_identifier
            );
    }


    public function getOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionDto
    {
        return GetOrganisationalUnitPositionCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositionById(
                $id
            );
    }


    /**
     * @return OrganisationalUnitPositionDto[]
     */
    public function getOrganisationalUnitPositions(bool $authorities = false) : array
    {
        return GetOrganisationalUnitPositionsCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositions(
                $authorities
            );
    }


    public function updateOrganisationalUnitPositionById(int $id, OrganisationalUnitPositionDiffDto $diff) : ?OrganisationalUnitPositionIdDto
    {
        return UpdateOrganisationalUnitPositionCommand::new(
            $this
        )
            ->updateOrganisationalUnitPositionById(
                $id,
                $diff
            );
    }
}
