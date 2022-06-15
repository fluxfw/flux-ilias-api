<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class GetKeepChangesInsideDaysCommand
{

    public const DEFAULT_VALUE = 7;
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


    public function getKeepChangesInsideDays() : int
    {
        return intval($this->config_service->getConfig(
                LegacyConfigKey::KEEP_CHANGES_INSIDE_DAYS()
            ) ?? static::DEFAULT_VALUE);
    }
}
