<?php

namespace FluxIliasApi\Channel\CronConfig\Command;

use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasApi\Channel\CronConfig\CustomInternalScheduleTypeCronConfig;
use FluxIliasApi\Channel\CronConfig\ScheduleTypeCronConfigMapping;
use ilCronJob;
use ilCronManager;

class GetCronJobScheduleCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function getCronJobSchedule(ilCronJob $cron_job) : object
    {
        $data = ilCronManager::getCronJobData($cron_job->getId());

        if (!empty($data)) {
            $data = current($data);
        } else {
            $data = [
                "schedule_type"  => $cron_job->getDefaultScheduleType(),
                "schedule_value" => $cron_job->getDefaultScheduleValue()
            ];
        }

        $internal_type = CustomInternalScheduleTypeCronConfig::factory($data["schedule_type"]);

        if (in_array($internal_type->value, $cron_job->getScheduleTypesWithValues())) {
            $interval = intval($data["schedule_value"]);
        } else {
            $interval = null;
        }

        return (object) [
            "type"           => ScheduleTypeCronConfigMapping::mapInternalToExternal($internal_type),
            "interval"       => $interval,
            "types"          => array_map(fn(int $type) : ScheduleTypeCronConfig => ScheduleTypeCronConfigMapping::mapInternalToExternal(CustomInternalScheduleTypeCronConfig::factory($type)),
                $cron_job->getValidScheduleTypes()),
            "interval_types" => array_map(fn(int $type) : ScheduleTypeCronConfig => ScheduleTypeCronConfigMapping::mapInternalToExternal(CustomInternalScheduleTypeCronConfig::factory($type)),
                $cron_job->getScheduleTypesWithValues())

        ];
    }
}
