<?php

namespace FluxIliasApi\Service\RestConfig\Port;

use FluxIliasApi\Service\Config\Port\ConfigService;
use FluxIliasApi\Service\RestConfig\Command\IsEnableRestApiCommand;
use FluxIliasApi\Service\RestConfig\Command\SetEnableRestApiCommand;

class RestConfigService
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    public function isEnableRestApi() : bool
    {
        return IsEnableRestApiCommand::new(
            $this->config_service
        )
            ->isEnableRestApi();
    }


    public function setEnableRestApi(bool $enable_rest_api) : void
    {
        SetEnableRestApiCommand::new(
            $this->config_service
        )
            ->setEnableRestApi(
                $enable_rest_api
            );
    }
}
