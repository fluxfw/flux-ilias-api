<?php

namespace FluxIliasApi\Adapter\Role;

class RoleDiffDto
{

    public ?string $description;
    public ?string $import_id;
    public ?string $title;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null
        );
    }
}
