<?php

namespace FluxIliasApi\Service\OrganisationalUnit\Command;

use FluxIliasApi\Adapter\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasApi\Adapter\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasApi\Service\OrganisationalUnit\OrganisationalUnitQuery;
use FluxIliasApi\Service\OrganisationalUnit\Port\OrganisationalUnitService;

class UpdateOrganisationalUnitCommand
{

    use OrganisationalUnitQuery;

    private OrganisationalUnitService $organisational_unit_service;


    private function __construct(
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service
    ) {
        $this->organisational_unit_service = $organisational_unit_service;
    }


    public static function new(
        OrganisationalUnitService $organisational_unit_service
    ) : static {
        return new static(
            $organisational_unit_service
        );
    }


    public function updateOrganisationalUnitByExternalId(string $external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitById(int $id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitById(
                $id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitByRefId(int $ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $diff
        );
    }


    private function updateOrganisationalUnit(?OrganisationalUnitDto $organisational_unit, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        if ($organisational_unit === null) {
            return null;
        }

        $ilias_organisational_unit = $this->getIliasOrganisationalUnit(
            $organisational_unit->id,
            $organisational_unit->ref_id
        );
        if ($ilias_organisational_unit === null) {
            return null;
        }

        $this->mapOrganisationalUnitDiff(
            $diff,
            $ilias_organisational_unit
        );

        $ilias_organisational_unit->update();

        return OrganisationalUnitIdDto::new(
            $organisational_unit->id,
            $diff->external_id ?? $organisational_unit->external_id,
            $organisational_unit->ref_id
        );
    }
}
