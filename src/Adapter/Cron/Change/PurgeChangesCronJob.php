<?php

namespace FluxIliasApi\Adapter\Cron\Change;

use FluxIliasApi\Channel\Change\Port\ChangeService;
use ilCronJob;
use ilCronJobResult;

class PurgeChangesCronJob extends ilCronJob
{

    public const ID = "flilre_purge_changes";
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
        return static::SCHEDULE_TYPE_DAILY;
    }


    public function getDefaultScheduleValue() : ?int
    {
        return null;
    }


    public function getDescription() : string
    {
        return "Automatically purge changes and only keep changes inside configured days";
    }


    public function getId() : string
    {
        return static::ID;
    }


    public function getTitle() : string
    {
        return "Purge changes";
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

        $count = $this->change_service->purgeChanges();

        if ($count !== null) {
            $result->setStatus(ilCronJobResult::STATUS_OK);
            $result->setMessage("Purged " . $count . " change(s)");
        } else {
            $result->setStatus(ilCronJobResult::STATUS_NO_ACTION);
        }

        return $result;
    }
}
