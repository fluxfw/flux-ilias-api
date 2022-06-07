<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionIdDto
{

    public ?int $id;


    private function __construct(
        /*public readonly*/ ?int $id
    ) {
        $this->id = $id;
    }


    public static function new(
        ?int $id = null
    ) : /*static*/ self
    {
        return new static(
            $id
        );
    }
}
