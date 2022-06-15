<?php

namespace FluxIliasApi\Adapter\User;

class UserDefinedFieldDto
{

    public ?int $id;
    public ?string $name;
    public ?string $value;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $name,
        /*public readonly*/ ?string $value
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }


    public static function new(
        ?int $id = null,
        ?string $name = null,
        ?string $value = null
    ) : static {
        return new static(
            $id,
            $name,
            $value
        );
    }


    public static function newFromObject(
        object $user_definied_field
    ) : static {
        return static::new(
            $user_definied_field->id ?? null,
            $user_definied_field->name ?? null,
            $user_definied_field->value ?? null
        );
    }
}
