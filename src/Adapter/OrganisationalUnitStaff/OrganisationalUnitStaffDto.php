<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitStaff;

class OrganisationalUnitStaffDto
{

    public ?string $organisational_unit_external_id;
    public ?int $organisational_unit_id;
    public ?int $organisational_unit_ref_id;
    public ?int $position_id;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $organisational_unit_id,
        /*public readonly*/ ?string $organisational_unit_external_id,
        /*public readonly*/ ?int $organisational_unit_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?int $position_id
    ) {
        $this->organisational_unit_id = $organisational_unit_id;
        $this->organisational_unit_external_id = $organisational_unit_external_id;
        $this->organisational_unit_ref_id = $organisational_unit_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->position_id = $position_id;
    }


    public static function new(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : /*static*/ self
    {
        return new static(
            $organisational_unit_id,
            $organisational_unit_external_id,
            $organisational_unit_ref_id,
            $user_id,
            $user_import_id,
            $position_id
        );
    }
}
