<?php

namespace FluxIliasApi\Service\OrganisationalUnitPosition\Port;

use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionCoreIdentifier;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasApi\Service\OrganisationalUnitPosition\Command\CreateOrganisationalUnitPositionCommand;
use FluxIliasApi\Service\OrganisationalUnitPosition\Command\DeleteOrganisationalUnitPositionCommand;
use FluxIliasApi\Service\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionCommand;
use FluxIliasApi\Service\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionsCommand;
use FluxIliasApi\Service\OrganisationalUnitPosition\Command\UpdateOrganisationalUnitPositionCommand;
use ilDBInterface;

class OrganisationalUnitPositionService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
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


    public function getOrganisationalUnitPositionByCoreIdentifier(OrganisationalUnitPositionCoreIdentifier $core_identifier) : ?OrganisationalUnitPositionDto
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
