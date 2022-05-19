<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class SetKeepChangesInsideDaysCommand
{

    private ConfigService $config_service;


    private function __construct(
        /*private readonly*/ ConfigService $config_service
    ) {
        $this->config_service = $config_service;
    }


    public static function new(
        ConfigService $config_service
    ) : /*static*/ self
    {
        return new static(
            $config_service
        );
    }


    public function setKeepChangesInsideDays(int $keep_changes_inside_days) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::KEEP_CHANGES_INSIDE_DAYS(),
            max(0, $keep_changes_inside_days)
        );
    }
}
