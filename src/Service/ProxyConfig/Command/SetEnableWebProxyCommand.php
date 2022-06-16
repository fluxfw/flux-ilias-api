<?php

namespace FluxIliasApi\Service\ProxyConfig\Command;

use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\Config\Port\ConfigService;

class SetEnableWebProxyCommand
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


    public function setEnableWebProxy(bool $enable_web_proxy) : void
    {
        $this->config_service->setConfig(
            LegacyConfigKey::ENABLE_WEB_PROXY(),
            $enable_web_proxy
        );
    }
}
