<?php

namespace FluxIliasApi\Adapter\Object;

class ObjectIdDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id
    ) {

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
