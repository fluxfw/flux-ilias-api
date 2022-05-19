<?php

namespace FluxIliasApi\Channel\CronConfig\Command;

use ilCronJob;
use ilCronManager;

class SetCronJobEnabledCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function setCronJobEnabled(ilCronJob $cron_job, bool $enabled) : void
    {
        if ($enabled) {
            ilCronManager::activateJob($cron_job, true);
        } else {
            ilCronManager::deactivateJob($cron_job, true);
        }
    }
}
