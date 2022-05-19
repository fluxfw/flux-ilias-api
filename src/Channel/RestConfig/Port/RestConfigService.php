<?php

namespace FluxIliasApi\Channel\RestConfig\Port;

use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\RestConfig\Command\IsEnableRestApiCommand;
use FluxIliasApi\Channel\RestConfig\Command\SetEnableRestApiCommand;

class RestConfigService
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
