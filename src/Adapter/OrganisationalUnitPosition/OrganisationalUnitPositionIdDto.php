<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionIdDto
{

    private function __construct(
        public readonly ?int $id
    ) {

    }


    public static function new(
        ?int $id = null
    ) : static {
        return new static(
            $id
        );
    }
}
