<?php

namespace FluxIliasApi\Adapter\Category;

use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class CategoryDto implements JsonSerializable
{

    public ?int $created;
    /**
     * @var CustomMetadataDto[]|null
     */
    public ?array $custom_metadata;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $icon_url;
    public ?int $id;
    public ?string $import_id;
    public ?bool $in_trash;
    public ?int $parent_id;
    public ?string $parent_import_id;
    public ?int $parent_ref_id;
    public ?int $ref_id;
    public ?string $title;
    public ?int $updated;
    public ?string $url;


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_import_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?bool $in_trash,
        /*public readonly*/ ?array $custom_metadata
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_import_id = $parent_import_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->didactic_template_id = $didactic_template_id;
        $this->in_trash = $in_trash;
        $this->custom_metadata = $custom_metadata;
    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null,
        ?array $custom_metadata = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $title,
            $description,
            $didactic_template_id,
            $in_trash,
            $custom_metadata
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
