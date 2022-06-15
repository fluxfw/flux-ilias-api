<?php

namespace FluxIliasApi\Service\CronConfig;

use FluxIliasApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyIntBackedEnum;

/**
 * @method static static DAILY() 1
 * @method static static EVERY_X_DAYS() 4
 * @method static static EVERY_X_HOURS() 3
 * @method static static EVERY_X_MINUTES() 2
 * @method static static MONTHLY() 6
 * @method static static QUARTERLY() 7
 * @method static static WEEKLY() 5
 * @method static static YEARLY() 8
 */
class LegacyDefaultInternalScheduleTypeCronConfig extends LegacyIntBackedEnum implements InternalScheduleTypeCronConfig
{

}
