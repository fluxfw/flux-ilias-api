<?php

namespace FluxIliasApi\Service\ProxyConfig\Port;

use FluxIliasApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Service\Config\Port\ConfigService;
use FluxIliasApi\Service\ProxyConfig\Command\GetApiProxyMapByKeyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\GetApiProxyMapCommand;
use FluxIliasApi\Service\ProxyConfig\Command\GetWebProxyIframeHeightOffsetCommand;
use FluxIliasApi\Service\ProxyConfig\Command\GetWebProxyMapByKeyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\GetWebProxyMapCommand;
use FluxIliasApi\Service\ProxyConfig\Command\IsEnableApiProxyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\IsEnableWebProxyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\SetApiProxyMapCommand;
use FluxIliasApi\Service\ProxyConfig\Command\SetEnableApiProxyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\SetEnableWebProxyCommand;
use FluxIliasApi\Service\ProxyConfig\Command\SetWebProxyIframeHeightOffsetCommand;
use FluxIliasApi\Service\ProxyConfig\Command\SetWebProxyMapCommand;

class ProxyConfigService
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


    /**
     * @return ApiProxyMapDto[]
     */
    public function getApiProxyMap() : array
    {
        return GetApiProxyMapCommand::new(
            $this->config_service
        )
            ->getApiProxyMap();
    }


    public function getApiProxyMapByKey(string $target_key) : ?ApiProxyMapDto
    {
        return GetApiProxyMapByKeyCommand::new(
            $this->getApiProxyMap()
        )
            ->getApiProxyMapByKey(
                $target_key
            );
    }


    public function getWebProxyIframeHeightOffset() : int
    {
        return GetWebProxyIframeHeightOffsetCommand::new(
            $this->config_service
        )
            ->getWebProxyIframeHeightOffset();
    }


    /**
     * @return WebProxyMapDto[]
     */
    public function getWebProxyMap() : array
    {
        return GetWebProxyMapCommand::new(
            $this->config_service
        )
            ->getWebProxyMap();
    }


    public function getWebProxyMapByKey(string $target_key) : ?WebProxyMapDto
    {
        return GetWebProxyMapByKeyCommand::new(
            $this->getWebProxyMap()
        )
            ->getWebProxyMapByKey(
                $target_key
            );
    }


    public function isEnableApiProxy() : bool
    {
        return IsEnableApiProxyCommand::new(
            $this->config_service
        )
            ->isEnableApiProxy();
    }


    public function isEnableWebProxy() : bool
    {
        return IsEnableWebProxyCommand::new(
            $this->config_service
        )
            ->isEnableWebProxy();
    }


    /**
     * @param ApiProxyMapDto[] $api_proxy_map
     */
    public function setApiProxyMap(array $api_proxy_map) : void
    {
        SetApiProxyMapCommand::new(
            $this->config_service
        )
            ->setApiProxyMap(
                $api_proxy_map
            );
    }


    public function setEnableApiProxy(bool $enable_api_proxy) : void
    {
        SetEnableApiProxyCommand::new(
            $this->config_service
        )
            ->setEnableApiProxy(
                $enable_api_proxy
            );
    }


    public function setEnableWebProxy(bool $enable_web_proxy) : void
    {
        SetEnableWebProxyCommand::new(
            $this->config_service
        )
            ->setEnableWebProxy(
                $enable_web_proxy
            );
    }


    public function setWebProxyIframeHeightOffset(?int $web_proxy_iframe_height_offset) : void
    {
        SetWebProxyIframeHeightOffsetCommand::new(
            $this->config_service
        )
            ->setWebProxyIframeHeightOffset(
                $web_proxy_iframe_height_offset
            );
    }


    /**
     * @param WebProxyMapDto[] $web_proxy_map
     */
    public function setWebProxyMap(array $web_proxy_map) : void
    {
        SetWebProxyMapCommand::new(
            $this->config_service
        )
            ->setWebProxyMap(
                $web_proxy_map
            );
    }
}
