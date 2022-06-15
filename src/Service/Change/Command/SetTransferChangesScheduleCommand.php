<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasApi\Service\Change\Port\ChangeService;
use FluxIliasApi\Service\CronConfig\Port\CronConfigService;

class SetTransferChangesScheduleCommand
{

    private ChangeService $change_service;
    private CronConfigService $cron_config_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ CronConfigService $cron_config_service
    ) {
        $this->change_service = $change_service;
        $this->cron_config_service = $cron_config_service;
    }


    public static function new(
        ChangeService $change_service,
        CronConfigService $cron_config_service
    ) : static {
        return new static(
            $change_service,
            $cron_config_service
        );
    }


    public function setTransferChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        $this->cron_config_service->setCronJobSchedule(
            $this->change_service->getTransferChangesCronJob(),
            $type,
            $interval
        );
    }
}
