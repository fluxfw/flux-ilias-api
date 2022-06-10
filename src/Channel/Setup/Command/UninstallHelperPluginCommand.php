<?php

namespace FluxIliasApi\Channel\Setup\Command;

use FluxIliasApi\Channel\Change\Port\ChangeService;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\Cron\Port\CronService;
use FluxIliasApi\Channel\ObjectConfig\Port\ObjectConfigService;

class UninstallHelperPluginCommand
{

    private ChangeService $change_service;
    private ConfigService $config_service;
    private CronService $cron_service;
    private ObjectConfigService $object_config_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ CronService $cron_service,
        /*private readonly*/ ObjectConfigService $object_config_service
    ) {
        $this->change_service = $change_service;
        $this->config_service = $config_service;
        $this->cron_service = $cron_service;
        $this->object_config_service = $object_config_service;
    }


    public static function new(
        ChangeService $change_service,
        ConfigService $config_service,
        CronService $cron_service,
        ObjectConfigService $object_config_service
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $config_service,
            $cron_service,
            $object_config_service
        );
    }


    public function uninstallHelperPlugin() : void
    {
        $this->change_service->dropChangeDatabase();
        $this->config_service->deleteConfig();
        $this->cron_service->deleteCronJobs();
        $this->object_config_service->deleteObjectConfigs();
    }
}
