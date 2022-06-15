<?php

namespace FluxIliasApi\Service\OrganisationalUnit\Command;

use FluxIliasApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasApi\Service\OrganisationalUnit\Port\OrganisationalUnitService;
use ilObjOrgUnit;

class GetOrganisationalUnitRootCommand
{

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


    public function getOrganisationalUnitRoot() : ?OrganisationalUnitDto
    {
        return $this->organisational_unit_service->getOrganisationalUnitByRefId(
            ilObjOrgUnit::getRootOrgRefId()
        );
    }
}
