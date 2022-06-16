<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionAuthorityDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?int $over_position_id,
        public readonly ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in
    ) {

    }


    public static function new(
        ?int $id = null,
        ?int $over_position_id = null,
        ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in = null
    ) : static {
        return new static(
            $id,
            $over_position_id,
            $scope_in
        );
    }


    public static function newFromObject(
        object $authority
    ) : static {
        return static::new(
            $authority->id ?? null,
            $authority->over_position_id ?? null,
            ($scope_in = $authority->scope_in ?? null) !== null ? LegacyOrganisationalUnitPositionAuthorityScopeIn::from($scope_in) : null
        );
    }
}
