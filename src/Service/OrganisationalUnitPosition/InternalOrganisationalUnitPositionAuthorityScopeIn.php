<?php

namespace FluxIliasApi\Service\OrganisationalUnitPosition;

// ilOrgUnitAuthority::SCOPE_SAME_ORGU
// ilOrgUnitAuthority::SCOPE_SUBSEQUENT_ORGUS

enum InternalOrganisationalUnitPositionAuthorityScopeIn: int
{

    case SAME = 1;
    case SAME_AND_SUBSEQUENT = 2;
}
