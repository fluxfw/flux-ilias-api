<?php

namespace FluxIliasApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionDiffDto
{

    private ?array $authorities;
    private ?string $description;
    private ?string $title;


    private function __construct(
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?array $authorities
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->authorities = $authorities;
    }


    public static function new(
        ?string $title = null,
        ?string $description = null,
        ?array $authorities = null
    ) : /*static*/ self
    {
        return new static(
            $title,
            $description,
            $authorities
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->title ?? null,
            $data->description ?? null,
            ($authorities = $data->authorities ?? null) !== null ? array_map([OrganisationalUnitPositionAuthorityDto::class, "newFromData"], $authorities) : null
        );
    }


    public function getAuthorities() : ?array
    {
        return $this->authorities;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }
}
