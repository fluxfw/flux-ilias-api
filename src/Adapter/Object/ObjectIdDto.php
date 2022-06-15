<?php

namespace FluxIliasApi\Adapter\Object;

class ObjectIdDto
{

    public ?int $id;
    public ?string $import_id;
    public ?int $ref_id;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id
        );
    }
}
