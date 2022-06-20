<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class IsEnableWebProxyCommand
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


    public function isEnableWebProxy() : bool
    {
        return boolval($this->config_service->getConfig(
            ConfigKey::ENABLE_WEB_PROXY
        ));
    }
}
