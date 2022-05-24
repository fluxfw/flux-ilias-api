<?php

namespace FluxIliasApi\Channel\CronConfig\Command;

use FluxIliasApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use ilCronJob;

class IsCronJobEnabledCommand
{

    private IliasCronWrapper $ilias_cron_wrapper;


    private function __construct(
        /*private readonly*/ IliasCronWrapper $ilias_cron_wrapper
    ) {
        $this->ilias_cron_wrapper = $ilias_cron_wrapper;
    }


    public static function new(
        IliasCronWrapper $ilias_cron_wrapper
    ) : /*static*/ self
    {
        return new static(
            $ilias_cron_wrapper
        );
    }


    public function isCronJobEnabled(ilCronJob $cron_job) : bool
    {
        return $this->ilias_cron_wrapper->isJobActive($cron_job->getId());
    }
}
