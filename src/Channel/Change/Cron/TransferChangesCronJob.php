<?php

namespace FluxIliasApi\Channel\Change\Cron;

use FluxIliasApi\Channel\Change\Port\ChangeService;
use ilCheckboxInputGUI;
use ilCronJob;
use ilCronJobResult;
use ilPropertyFormGUI;
use ilTextInputGUI;

class TransferChangesCronJob extends ilCronJob
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


    public function addCustomSettingsToForm(ilPropertyFormGUI $a_form) : void
    {
        $enable_log_changes = new ilCheckboxInputGUI("Enable log changes", "enable_log_changes");
        $enable_log_changes->setChecked($this->change_service->isEnabledLogChanges());
        $a_form->addItem($enable_log_changes);

        $post_url = new ilTextInputGUI("Post url", "post_url");
        $post_url->setValue($this->change_service->getTransferChangesPostUrl());
        $a_form->addItem($post_url);
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
        return "flilre_transfer_changes";
    }


    public function getTitle() : string
    {
        return "Transfer changes";
    }


    public function hasAutoActivation() : bool
    {
        return false;
    }


    public function hasCustomSettings() : bool
    {
        return true;
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


    public function saveCustomSettings(ilPropertyFormGUI $a_form) : bool
    {
        $this->change_service->setEnabledLogChanges(
            boolval($a_form->getInput("enable_log_changes"))
        );

        $this->change_service->setTransferChangesPostUrl(
            strval($a_form->getInput("post_url"))
        );

        return true;
    }
}
