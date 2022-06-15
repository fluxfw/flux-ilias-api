<?php

namespace FluxIliasApi\Service\CronConfig\Command;

use FluxIliasApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use ilCronJob;
use ilObjUser;

class SetCronJobEnabledCommand
{

    private IliasCronWrapper $ilias_cron_wrapper;
    private ilObjUser $ilias_user;


    private function __construct(
        /*private readonly*/ IliasCronWrapper $ilias_cron_wrapper,
        /*private readonly*/ ilObjUser $ilias_user
    ) {
        $this->ilias_cron_wrapper = $ilias_cron_wrapper;
        $this->ilias_user = $ilias_user;
    }


    public static function new(
        IliasCronWrapper $ilias_cron_wrapper,
        ilObjUser $ilias_user
    ) : static {
        return new static(
            $ilias_cron_wrapper,
            $ilias_user
        );
    }


    public function setCronJobEnabled(ilCronJob $cron_job, bool $enabled) : void
    {
        if ($enabled) {
            $this->ilias_cron_wrapper->activateJob($cron_job, $this->ilias_user, true);
        } else {
            $this->ilias_cron_wrapper->deactivateJob($cron_job, $this->ilias_user, true);
        }
    }
}
