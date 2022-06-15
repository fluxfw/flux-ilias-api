<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionDto
{

    /**
     * @var OrganisationalUnitPositionAuthorityDto[]|null
     */
    public ?array $authorities;
    public ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier;
    public ?bool $core_position;
    public ?string $description;
    public ?int $id;
    public ?string $title;


    /**
     * @param OrganisationalUnitPositionAuthorityDto[]|null $authorities
     */
    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?bool $core_position,
        /*public readonly*/ ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?array $authorities
    ) {
        $this->id = $id;
        $this->core_position = $core_position;
        $this->core_identifier = $core_identifier;
        $this->title = $title;
        $this->description = $description;
        $this->authorities = $authorities;
    }


    /**
     * @param OrganisationalUnitPositionAuthorityDto[]|null $authorities
     */
    public static function new(
        ?int $id = null,
        ?bool $core_position = null,
        ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier = null,
        ?string $title = null,
        ?string $description = null,
        ?array $authorities = null
    ) : static {
        return new static(
            $id,
            $core_position,
            $core_identifier,
            $title,
            $description,
            $authorities
        );
    }
}
