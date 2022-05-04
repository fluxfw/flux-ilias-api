<?php

namespace FluxIliasApi\Adapter\CustomMetadata;

use FluxIliasApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyStringBackedEnum;

/**
 * @method static static FLOAT() float
 * @method static static INTEGER() integer
 * @method static static MULTIPLE_CHOICE() multiple_choice
 * @method static static SINGLE_CHOICE() single_choice
 * @method static static TEXT() text
 */
class LegacyDefaultCustomMetadataFieldType extends LegacyStringBackedEnum implements CustomMetadataFieldType
{

}
