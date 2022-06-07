<?php

namespace FluxIliasApi\Adapter\OrganisationalUnit;

class OrganisationalUnitDiffDto
{

    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $external_id;
    public ?string $title;
    public ?int $type_id;


    private function __construct(
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $type_id,
        /*public readonly*/ ?string $external_id,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->type_id = $type_id;
        $this->external_id = $external_id;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->title ?? null,
            $data->description ?? null,
            $data->type_id ?? null,
            $data->external_id ?? null,
            $data->didactic_template_id ?? null
        );
    }
}
