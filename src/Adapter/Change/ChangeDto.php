<?php

namespace FluxIliasApi\Adapter\Change;

class ChangeDto
{

    public object $data;
    public int $id;
    public float $time;
    public LegacyChangeType $type;
    public int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ int $id,
        /*public readonly*/ LegacyChangeType $type,
        /*public readonly*/ float $time,
        /*public readonly*/ int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ object $data
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->time = $time;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->data = $data;
    }


    public static function new(
        int $id,
        LegacyChangeType $type,
        float $time,
        int $user_id,
        ?string $user_import_id,
        object $data
    ) : /*static*/ self
    {
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
