<?php

namespace FluxIliasApi\Adapter\Category;

use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataDto;

class CategoryDiffDto
{

    /**
     * @var CustomMetadataDto[]|null
     */
    public ?array $custom_metadata;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $import_id;
    public ?string $title;


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?array $custom_metadata
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
        $this->didactic_template_id = $didactic_template_id;
        $this->custom_metadata = $custom_metadata;
    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null,
        ?array $custom_metadata = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $title,
            $description,
            $didactic_template_id,
            $custom_metadata
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            $data->didactic_template_id ?? null,
            ($custom_metadata = $data->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromData"], $custom_metadata) : null
        );
    }
}
