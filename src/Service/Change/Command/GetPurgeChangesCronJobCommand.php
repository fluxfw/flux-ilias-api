<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Adapter\Cron\Change\PurgeChangesCronJob;
use FluxIliasApi\Service\Change\Port\ChangeService;

class GetPurgeChangesCronJobCommand
{

    private ChangeService $change_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->change_service = $change_service;
    }


    public static function new(
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $change_service
        );
    }


    public function getPurgeChangesCronJob() : PurgeChangesCronJob
    {
        return PurgeChangesCronJob::new(
            $this->change_service
        );
    }
}
