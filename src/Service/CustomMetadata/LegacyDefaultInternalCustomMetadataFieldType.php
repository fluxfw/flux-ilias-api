<?php

namespace FluxIliasApi\Service\CustomMetadata;

use FluxIliasApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyIntBackedEnum;

/**
 * @method static static FLOAT() 6
 * @method static static INTEGER() 5
 * @method static static SELECT() 1
 * @method static static SELECT_MULTI() 8
 * @method static static TEXT() 2
 */
class LegacyDefaultInternalCustomMetadataFieldType extends LegacyIntBackedEnum implements InternalCustomMetadataFieldType
{

}
