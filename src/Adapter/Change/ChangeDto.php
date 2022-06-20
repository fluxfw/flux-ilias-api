<?php

namespace FluxIliasApi\Adapter\Change;

class ChangeDto
{

    private function __construct(
        public readonly int $id,
        public readonly ChangeType $type,
        public readonly float $time,
        public readonly int $user_id,
        public readonly ?string $user_import_id,
        public readonly object $data
    ) {

    }


    public static function new(
        int $id,
        ChangeType $type,
        float $time,
        int $user_id,
        ?string $user_import_id,
        object $data
    ) : static {
        return new static(
            $id,
            $type,
            $time,
            $user_id,
            $user_import_id,
            $data
        );
    }
}
