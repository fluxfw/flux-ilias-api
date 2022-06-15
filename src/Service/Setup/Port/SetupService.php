<?php

namespace FluxIliasApi\Service\Setup\Port;

use FluxIliasApi\Service\Change\Port\ChangeService;
use FluxIliasApi\Service\Config\Port\ConfigService;
use FluxIliasApi\Service\Cron\Port\CronService;
use FluxIliasApi\Service\ObjectConfig\Port\ObjectConfigService;
use FluxIliasApi\Service\Setup\Command\InstallHelperPluginCommand;
use FluxIliasApi\Service\Setup\Command\UninstallHelperPluginCommand;

class SetupService
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


    public function installHelperPlugin() : void
    {
        InstallHelperPluginCommand::new(
            $this->change_service
        )
            ->installHelperPlugin();
    }


    public function uninstallHelperPlugin() : void
    {
        UninstallHelperPluginCommand::new(
            $this->change_service,
            $this->config_service,
            $this->cron_service,
            $this->object_config_service
        )
            ->uninstallHelperPlugin();
    }
}
