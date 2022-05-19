<?php

namespace FluxIliasApi\Channel\CronConfig\Command;

use ilCronJob;
use ilCronManager;

class IsCronJobEnabledCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function isCronJobEnabled(ilCronJob $cron_job) : bool
    {
        return ilCronManager::isJobActive($cron_job->getId());
    }
}
