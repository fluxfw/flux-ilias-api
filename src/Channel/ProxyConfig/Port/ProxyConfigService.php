<?php

namespace FluxIliasApi\Channel\ProxyConfig\Port;

use FluxIliasApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\ObjectApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;
use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\ProxyConfig\Command\GetApiProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetObjectApiProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetObjectApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetObjectWebProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetObjectWebProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetWebProxyIframeHeightOffsetCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetWebProxyMapByKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\GetWebProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableObjectApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableObjectWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\IsEnableWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableObjectApiProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableObjectWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetEnableWebProxyCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetObjectApiProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetObjectWebProxyMapCommand;
use FluxIliasApi\Channel\ProxyConfig\Command\SetWebProxyIframeHeightOffsetCommand;
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


    public function getApiProxyMapByKey(string $target_key) : ?ApiProxyMapDto
    {
        return GetApiProxyMapByKeyCommand::new(
            $this->getApiProxyMap()
        )
            ->getApiProxyMapByKey(
                $target_key
            );
    }


    /**
     * @return ObjectApiProxyMapDto[]
     */
    public function getObjectApiProxyMap() : array
    {
        return GetObjectApiProxyMapCommand::new(
            $this->config_service
        )
            ->getObjectApiProxyMap();
    }


    public function getObjectApiProxyMapByKey(string $key) : ?ObjectApiProxyMapDto
    {
        return GetObjectApiProxyMapByKeyCommand::new(
            $this->getObjectApiProxyMap()
        )
            ->getObjectApiProxyMapByKey(
                $key
            );
    }


    /**
     * @return ObjectWebProxyMapDto[]
     */
    public function getObjectWebProxyMap() : array
    {
        return GetObjectWebProxyMapCommand::new(
            $this->config_service
        )
            ->getObjectWebProxyMap();
    }


    public function getObjectWebProxyMapByKey(string $key) : ?ObjectWebProxyMapDto
    {
        return GetObjectWebProxyMapByKeyCommand::new(
            $this->getObjectWebProxyMap()
        )
            ->getObjectWebProxyMapByKey(
                $key
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


    public function isEnableObjectApiProxy() : bool
    {
        return IsEnableObjectApiProxyCommand::new(
            $this->config_service
        )
            ->isEnableObjectApiProxy();
    }


    public function isEnableObjectWebProxy() : bool
    {
        return IsEnableObjectWebProxyCommand::new(
            $this->config_service
        )
            ->isEnableObjectWebProxy();
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


    public function setEnableObjectApiProxy(bool $enable_object_api_proxy) : void
    {
        SetEnableObjectApiProxyCommand::new(
            $this->config_service
        )
            ->setEnableObjectApiProxy(
                $enable_object_api_proxy
            );
    }


    public function setEnableObjectWebProxy(bool $enable_object_web_proxy) : void
    {
        SetEnableObjectWebProxyCommand::new(
            $this->config_service
        )
            ->setEnableObjectWebProxy(
                $enable_object_web_proxy
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
     * @param ObjectApiProxyMapDto[] $object_api_proxy_map
     */
    public function setObjectApiProxyMap(array $object_api_proxy_map) : void
    {
        SetObjectApiProxyMapCommand::new(
            $this->config_service
        )
            ->setObjectApiProxyMap(
                $object_api_proxy_map
            );
    }


    /**
     * @param ObjectWebProxyMapDto[] $object_web_proxy_map
     */
    public function setObjectWebProxyMap(array $object_web_proxy_map) : void
    {
        SetObjectWebProxyMapCommand::new(
            $this->config_service
        )
            ->setObjectWebProxyMap(
                $object_web_proxy_map
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
