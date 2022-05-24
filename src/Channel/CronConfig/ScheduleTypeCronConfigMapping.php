<?php

namespace FluxIliasApi\Channel\CronConfig;

use FluxIliasApi\Adapter\CronConfig\CustomScheduleTypeCronConfig;
use FluxIliasApi\Adapter\CronConfig\LegacyDefaultScheduleTypeCronConfig;
use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;

class ScheduleTypeCronConfigMapping
{

    public static function mapExternalToInternal(ScheduleTypeCronConfig $type) : InternalScheduleTypeCronConfig
    {
        return CustomInternalScheduleTypeCronConfig::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalScheduleTypeCronConfig $type) : ScheduleTypeCronConfig
    {
        return CustomScheduleTypeCronConfig::factory(
            static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyDefaultInternalScheduleTypeCronConfig::DAILY()->value           => LegacyDefaultScheduleTypeCronConfig::DAILY()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::EVERY_X_DAYS()->value    => LegacyDefaultScheduleTypeCronConfig::EVERY_X_DAYS()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::EVERY_X_HOURS()->value   => LegacyDefaultScheduleTypeCronConfig::EVERY_X_HOURS()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::EVERY_X_MINUTES()->value => LegacyDefaultScheduleTypeCronConfig::EVERY_X_MINUTES()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::MONTHLY()->value         => LegacyDefaultScheduleTypeCronConfig::MONTHLY()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::QUARTERLY()->value       => LegacyDefaultScheduleTypeCronConfig::QUARTERLY()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::WEEKLY()->value          => LegacyDefaultScheduleTypeCronConfig::WEEKLY()->value,
            LegacyDefaultInternalScheduleTypeCronConfig::YEARLY()->value          => LegacyDefaultScheduleTypeCronConfig::YEARLY()->value
        ];
    }
}
