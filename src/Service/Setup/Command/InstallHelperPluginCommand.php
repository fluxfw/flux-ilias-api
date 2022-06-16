<?php

namespace FluxIliasApi\Service\Setup\Command;

use FluxIliasApi\Service\Change\Port\ChangeService;

class InstallHelperPluginCommand
{

    private function __construct(
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ChangeService $change_service
    ) : static {
        return new static(
            $change_service
        );
    }


    public function installHelperPlugin() : void
    {
        $this->change_service->createChangeDatabase();
    }
}
