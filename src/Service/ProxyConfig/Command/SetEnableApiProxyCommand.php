<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetEnableApiProxyCommand
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


    public function setEnableApiProxy(bool $enable_api_proxy) : void
    {
        $this->config_service->setConfig(
            ConfigKey::ENABLE_API_PROXY,
            $enable_api_proxy
        );
    }
}
