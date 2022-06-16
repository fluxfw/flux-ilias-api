<?php

namespace FluxIliasApi\Adapter\Object;

use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class ObjectDto implements JsonSerializable
{

    /**
     * @param int[]|null               $ref_ids
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?array $ref_ids,
        public readonly ?ObjectType $type,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $icon_url,
        public readonly ?bool $online,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $didactic_template_id,
        public readonly ?bool $in_trash,
        public readonly ?array $custom_metadata
    ) {

    }


    /**
     * @param int[]|null               $ref_ids
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?array $ref_ids = null,
        ?ObjectType $type = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?bool $online = null,
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
            $ref_ids,
            $type,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $online,
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
