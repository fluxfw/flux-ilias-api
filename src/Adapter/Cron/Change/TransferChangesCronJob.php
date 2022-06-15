<?php

namespace FluxIliasApi\Adapter\Cron\Change;

use FluxIliasApi\Service\Change\Port\ChangeService;
use ilCronJob;
use ilCronJobResult;

class TransferChangesCronJob extends ilCronJob
{

    public const ID = "flilre_transfer_changes";
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


    public function getDefaultScheduleType() : int
    {
        return static::SCHEDULE_TYPE_IN_MINUTES;
    }


    public function getDefaultScheduleValue() : ?int
    {
        return 5;
    }


    public function getDescription() : string
    {
        return "Transfer new changes after last run to configured url";
    }


    public function getId() : string
    {
        return static::ID;
    }


    public function getTitle() : string
    {
        return "Transfer changes";
    }


    public function hasAutoActivation() : bool
    {
        return false;
    }


    public function hasFlexibleSchedule() : bool
    {
        return true;
    }


    public function run() : ilCronJobResult
    {
        $result = new ilCronJobResult();

        $count = $this->change_service->transferChanges();

        if ($count !== null) {
            $result->setStatus(ilCronJobResult::STATUS_OK);
            $result->setMessage("Transferred " . $count . " change(s)");
        } else {
            $result->setStatus(ilCronJobResult::STATUS_NO_ACTION);
        }

        return $result;
    }
}
