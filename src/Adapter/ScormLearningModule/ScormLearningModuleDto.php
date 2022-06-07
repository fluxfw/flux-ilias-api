<?php

namespace FluxIliasApi\Adapter\ScormLearningModule;

use JsonSerializable;

class ScormLearningModuleDto implements JsonSerializable
{

    public ?bool $authoring_mode;
    public ?int $created;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $icon_url;
    public ?int $id;
    public ?string $import_id;
    public ?bool $in_trash;
    public ?bool $online;
    public ?int $parent_id;
    public ?string $parent_import_id;
    public ?int $parent_ref_id;
    public ?int $ref_id;
    public ?bool $sequencing_expert_mode;
    public ?string $title;
    public ?LegacyScormLearningModuleType $type;
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
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?LegacyScormLearningModuleType $type,
        /*public readonly*/ ?int $version,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?bool $authoring_mode,
        /*public readonly*/ ?bool $sequencing_expert_mode,
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
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->version = $version;
        $this->online = $online;
        $this->authoring_mode = $authoring_mode;
        $this->sequencing_expert_mode = $sequencing_expert_mode;
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
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?LegacyScormLearningModuleType $type = null,
        ?int $version = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null,
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
            $type,
            $version,
            $online,
            $authoring_mode,
            $sequencing_expert_mode,
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
