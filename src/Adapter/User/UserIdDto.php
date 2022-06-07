<?php

namespace FluxIliasApi\Adapter\User;

class UserIdDto
{

    public ?int $id;
    public ?string $import_id;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id
        );
    }
}
