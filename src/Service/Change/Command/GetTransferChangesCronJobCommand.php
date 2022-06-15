<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Adapter\Cron\Change\TransferChangesCronJob;
use FluxIliasApi\Service\Change\Port\ChangeService;

class GetTransferChangesCronJobCommand
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


    public function getTransferChangesCronJob() : TransferChangesCronJob
    {
        return TransferChangesCronJob::new(
            $this->change_service
        );
    }
}
