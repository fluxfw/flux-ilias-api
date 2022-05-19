<?php

namespace FluxIliasApi\Channel\CronConfig\Port;

use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasApi\Channel\CronConfig\Command\GetCronJobScheduleCommand;
use FluxIliasApi\Channel\CronConfig\Command\IsCronJobEnabledCommand;
use FluxIliasApi\Channel\CronConfig\Command\SetCronJobEnabledCommand;
use FluxIliasApi\Channel\CronConfig\Command\SetCronJobScheduleCommand;
use ilCronJob;

class CronConfigService
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
        return GetCronJobScheduleCommand::new()
            ->getCronJobSchedule(
                $cron_job
            );
    }


    public function isCronJobEnabled(ilCronJob $cron_job) : bool
    {
        return IsCronJobEnabledCommand::new()
            ->isCronJobEnabled(
                $cron_job
            );
    }


    public function setCronJobEnabled(ilCronJob $cron_job, bool $enabled) : void
    {
        SetCronJobEnabledCommand::new()
            ->setCronJobEnabled(
                $cron_job,
                $enabled
            );
    }


    public function setCronJobSchedule(ilCronJob $cron_job, ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetCronJobScheduleCommand::new()
            ->setCronJobSchedule(
                $cron_job,
                $type,
                $interval
            );
    }
}
