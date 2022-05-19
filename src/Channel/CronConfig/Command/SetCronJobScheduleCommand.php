<?php

namespace FluxIliasApi\Channel\CronConfig\Command;

use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasApi\Channel\CronConfig\ScheduleTypeCronConfigMapping;
use ilCronJob;
use ilCronManager;

class SetCronJobScheduleCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function setCronJobSchedule(ilCronJob $cron_job, ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        $internal_type = ScheduleTypeCronConfigMapping::mapExternalToInternal($type);

        if (in_array($internal_type->value, $cron_job->getValidScheduleTypes())) {
            if (in_array($internal_type->value, $cron_job->getScheduleTypesWithValues())) {
                $interval = max(0, $interval);
            } else {
                $interval = null;
            }

            ilCronManager::updateJobSchedule($cron_job, $internal_type->value, $interval);
        }
    }
}
