<?php

namespace FluxIliasApi\Adapter\CronConfig;

use FluxIliasApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyStringBackedEnum;

/**
 * @method static static DAILY() daily
 * @method static static EVERY_X_DAYS() every_x_days
 * @method static static EVERY_X_HOURS() every_x_hours
 * @method static static EVERY_X_MINUTES() every_x_minutes
 * @method static static MONTHLY() monthly
 * @method static static QUARTERLY() quarterly
 * @method static static WEEKLY() weekly
 * @method static static YEARLY() yearly
 */
class LegacyDefaultScheduleTypeCronConfig extends LegacyStringBackedEnum implements ScheduleTypeCronConfig
{

}
