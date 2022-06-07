<?php

namespace FluxIliasApi\Adapter\File;

class FileDiffDto
{

    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $import_id;
    public ?string $title;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $title,
            $description,
            $didactic_template_id
        );
    }


    public static function newFromObject(
        object $diff
    ) : /*static*/ self
    {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->didactic_template_id ?? null
        );
    }
}
