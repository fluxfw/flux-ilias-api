<?php

namespace FluxIliasApi\Adapter\User;

class UserIdDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null
    ) : static {
        return new static(
            $id,
            $import_id
        );
    }
}
