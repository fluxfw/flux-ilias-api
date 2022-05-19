<?php

namespace FluxIliasApi\Channel\ProxyConfig\Port;

use FluxIliasApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\ProxyConfig\Command\GetApiProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetWebProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetWebProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetWebProxyMapCommand;

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


    public function getApiProxyMapByKey(string $key) : ?ApiProxyMapDto
    {
        return GetApiProxyMapByKeyCommand::new(
            $this->getApiProxyMap()
        )
            ->getApiProxyMapByKey(
                $key
            );
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


    public function getWebProxyMapByKey(string $key) : ?WebProxyMapDto
    {
        return GetWebProxyMapByKeyCommand::new(
            $this->getWebProxyMap()
        )
            ->getWebProxyMapByKey(
                $key
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
