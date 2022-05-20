<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\Config\Port\ConfigService;

class GetWebProxyIframeHeightOffsetCommand
{

    public const DEFAULT_VALUE = 220;
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


    public function getWebProxyIframeHeightOffset() : int
    {
        return intval($this->config_service->getConfig(
                LegacyConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET()
            ) ?? static::DEFAULT_VALUE);
    }
}
