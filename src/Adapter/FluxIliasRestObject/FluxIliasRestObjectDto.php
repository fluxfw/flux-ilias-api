<?php

namespace FluxIliasApi\Adapter\FluxIliasRestObject;

use JsonSerializable;

class FluxIliasRestObjectDto implements JsonSerializable
{

    public ?string $api_proxy_map_key;
    public ?int $created;
    public ?string $description;
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
    public ?string $web_proxy_map_key;


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
        /*public readonly*/ ?string $web_proxy_map_key,
        /*public readonly*/ ?string $api_proxy_map_key,
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
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->web_proxy_map_key = $web_proxy_map_key;
        $this->api_proxy_map_key = $api_proxy_map_key;
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
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?string $web_proxy_map_key = null,
        ?string $api_proxy_map_key = null,
        ?bool $in_trash = null
    ) : /*static*/ self
    {
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
            $web_proxy_map_key,
            $api_proxy_map_key,
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
