<?php

namespace FluxIliasApi\Adapter\Role;

class RoleDto
{

    public ?int $created;
    public ?string $description;
    public ?int $id;
    public ?string $import_id;
    public ?int $object_id;
    public ?string $object_import_id;
    public ?int $object_ref_id;
    public ?string $title;
    public ?int $updated;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $object_id,
        /*public readonly*/ ?string $object_import_id,
        /*public readonly*/ ?int $object_ref_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->object_id = $object_id;
        $this->object_import_id = $object_import_id;
        $this->object_ref_id = $object_ref_id;
        $this->title = $title;
        $this->description = $description;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?string $title = null,
        ?string $description = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id,
            $created,
            $updated,
            $object_id,
            $object_import_id,
            $object_ref_id,
            $title,
            $description
        );
    }
}
