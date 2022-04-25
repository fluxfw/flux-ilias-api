<?php

namespace FluxIliasApi\Channel\Change\Command;

use FluxIliasApi\Channel\Config\Port\ConfigService;

class EnableLogChangesConfigCommand
{

    private const CONFIG_KEY = "enable_log_changes";
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


    public function isEnabledLogChanges() : bool
    {
        return boolval($this->config_service->getConfig(
            static::CONFIG_KEY
        ));
    }


    public function setEnabledLogChanges(bool $enable_log_changes) : void
    {
        $this->config_service->setConfig(
            static::CONFIG_KEY,
            $enable_log_changes
        );
    }
}
