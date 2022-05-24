<?php

namespace FluxIliasApi\Adapter\CustomMetadata;

use JsonSerializable;

class CustomMetadataDto implements JsonSerializable
{

    private ?int $field_id;
    private ?string $field_title;
    private ?CustomMetadataFieldType $field_type;
    private ?int $record_id;
    private ?string $record_title;
    private /*mixed*/
        $value;


    private function __construct(
        /*public readonly*/ ?int $field_id,
        /*public readonly*/ ?string $field_title,
        /*public readonly*/ ?int $record_id,
        /*public readonly*/ ?string $record_title,
        /*public readonly mixed*/ $value,
        /*public readonly*/ ?CustomMetadataFieldType $field_type
    ) {
        $this->field_id = $field_id;
        $this->field_title = $field_title;
        $this->record_id = $record_id;
        $this->record_title = $record_title;
        $this->value = $value;
        $this->field_type = $field_type;
    }


    public static function new(
        ?int $field_id = null,
        ?string $field_title = null,
        ?int $record_id = null,
        ?string $record_title = null,
        /*mixed*/ $value = null,
        ?CustomMetadataFieldType $field_type = null
    ) : /*static*/ self
    {
        return new static(
            $field_id,
            $field_title,
            $record_id,
            $record_title,
            $value,
            $field_type
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->field_id ?? null,
            $data->field_title ?? null,
            $data->record_id ?? null,
            $data->record_title ?? null,
            $data->value ?? null,
            ($field_type = $data->field_type ?? null) !== null ? CustomCustomMetadataFieldType::factory(
                $field_type
            ) : null
        );
    }


    public function getFieldId() : ?int
    {
        return $this->field_id;
    }


    public function getFieldTitle() : ?string
    {
        return $this->field_title;
    }


    public function getFieldType() : ?CustomMetadataFieldType
    {
        return $this->field_type;
    }


    public function getRecordId() : ?int
    {
        return $this->record_id;
    }


    public function getRecordTitle() : ?string
    {
        return $this->record_title;
    }


    public function getValue()/* : mixed*/
    {
        return $this->value;
    }


    public function jsonSerialize() : object
    {
        return (object) get_object_vars($this);
    }
}
