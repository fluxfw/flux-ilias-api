<?php

namespace FluxIliasApi\Service\Cron\Command;

use FluxIliasApi\Service\Change\Port\ChangeService;
use ilCronJob;

class GetCronJobsCommand
{

    private function __construct(
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ChangeService $change_service
    ) : static {
        return new static(
            $change_service
        );
    }


    /**
     * @return ilCronJob[]
     */
    public function getCronJobs() : array
    {
        return $this->change_service->getChangeCronJobs();
    }
}
