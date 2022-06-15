<?php

namespace FluxIliasApi\Service\CustomMetadata;

use FluxIliasApi\Adapter\CustomMetadata\CustomCustomMetadataFieldType;
use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataFieldType;
use FluxIliasApi\Adapter\CustomMetadata\LegacyDefaultCustomMetadataFieldType;

class CustomMetadataFieldTypeMapping
{

    public static function mapExternalToInternal(CustomMetadataFieldType $type) : InternalCustomMetadataFieldType
    {
        return CustomInternalCustomMetadataFieldType::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalCustomMetadataFieldType $type) : CustomMetadataFieldType
    {
        return CustomCustomMetadataFieldType::factory(
            static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyDefaultInternalCustomMetadataFieldType::FLOAT()->value        => LegacyDefaultCustomMetadataFieldType::FLOAT()->value,
            LegacyDefaultInternalCustomMetadataFieldType::INTEGER()->value      => LegacyDefaultCustomMetadataFieldType::INTEGER()->value,
            LegacyDefaultInternalCustomMetadataFieldType::SELECT()->value       => LegacyDefaultCustomMetadataFieldType::SINGLE_CHOICE()->value,
            LegacyDefaultInternalCustomMetadataFieldType::SELECT_MULTI()->value => LegacyDefaultCustomMetadataFieldType::MULTIPLE_CHOICE()->value,
            LegacyDefaultInternalCustomMetadataFieldType::TEXT()->value         => LegacyDefaultCustomMetadataFieldType::TEXT()->value
        ];
    }
}
