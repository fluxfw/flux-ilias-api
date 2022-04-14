<?php

namespace FluxIliasApi\Channel\Setup\Port;

use FluxIliasApi\Channel\Change\Port\ChangeService;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\Cron\Port\CronService;
use FluxIliasApi\Channel\Setup\Command\InstallHelperPluginCommand;
use FluxIliasApi\Channel\Setup\Command\UninstallHelperPluginCommand;

class SetupService
{

    private ChangeService $change_service;
    private ConfigService $config_service;
    private CronService $cron_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ CronService $cron_service
    ) {
        $this->change_service = $change_service;
        $this->config_service = $config_service;
        $this->cron_service = $cron_service;
    }


    public static function new(
        ChangeService $change_service,
        ConfigService $config_service,
        CronService $cron_service
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $config_service,
            $cron_service
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
            $this->cron_service
        )
            ->uninstallHelperPlugin();
    }
}