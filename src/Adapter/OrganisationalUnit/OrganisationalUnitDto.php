<?php

namespace FluxIliasApi\Adapter\OrganisationalUnit;

class OrganisationalUnitDto
{

    public ?int $created;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $external_id;
    public ?int $id;
    public ?string $parent_external_id;
    public ?int $parent_id;
    public ?int $parent_ref_id;
    public ?int $ref_id;
    public ?string $title;
    public ?int $type_id;
    public ?int $updated;
    public ?string $url;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_external_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $type_id,
        /*public readonly*/ ?string $external_id,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->id = $id;
        $this->ref_id = $ref_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_external_id = $parent_external_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->type_id = $type_id;
        $this->external_id = $external_id;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?int $id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_external_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_external_id,
            $parent_ref_id,
            $url,
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
        );
    }
}
