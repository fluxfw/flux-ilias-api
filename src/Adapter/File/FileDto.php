<?php

namespace FluxIliasApi\Adapter\File;

use JsonSerializable;

class FileDto implements JsonSerializable
{

    public ?int $created;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $download_url;
    public ?string $icon_url;
    public ?int $id;
    public ?string $import_id;
    public ?bool $in_trash;
    public ?string $mime_type;
    public ?string $name;
    public ?int $parent_id;
    public ?string $parent_import_id;
    public ?int $parent_ref_id;
    public ?int $ref_id;
    public ?int $size;
    public ?string $title;
    public ?int $updated;
    public ?string $url;
    public ?int $version;


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
        /*public readonly*/ ?string $download_url,
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $version,
        /*public readonly*/ ?string $name,
        /*public readonly*/ ?int $size,
        /*public readonly*/ ?string $mime_type,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?bool $in_trash
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
        $this->download_url = $download_url;
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->version = $version;
        $this->name = $name;
        $this->size = $size;
        $this->mime_type = $mime_type;
        $this->didactic_template_id = $didactic_template_id;
        $this->in_trash = $in_trash;
    }


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
        ?string $download_url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $version = null,
        ?string $name = null,
        ?int $size = null,
        ?string $mime_type = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null
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
            $download_url,
            $icon_url,
            $title,
            $description,
            $version,
            $name,
            $size,
            $mime_type,
            $didactic_template_id,
            $in_trash
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
