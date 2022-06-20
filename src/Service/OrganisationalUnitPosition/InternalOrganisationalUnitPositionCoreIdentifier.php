<?php

namespace FluxIliasApi\Service\OrganisationalUnitPosition;

// ilOrgUnitPosition::CORE_POSITION_EMPLOYEE
// ilOrgUnitPosition::CORE_POSITION_SUPERIOR

enum InternalOrganisationalUnitPositionCoreIdentifier: int
{

    case EMPLOYEE = 1;
    case SUPERIOR = 2;
}
