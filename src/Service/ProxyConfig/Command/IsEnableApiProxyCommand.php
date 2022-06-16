<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class IsEnableApiProxyCommand
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


    public function isEnableApiProxy() : bool
    {
        return boolval($this->config_service->getConfig(
            LegacyConfigKey::ENABLE_API_PROXY()
        ));
    }
}
