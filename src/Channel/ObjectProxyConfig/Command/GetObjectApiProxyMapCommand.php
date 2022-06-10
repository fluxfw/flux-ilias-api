<?php

namespace FluxIliasApi\Channel\ObjectProxyConfig\Command;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Proxy\ObjectApiProxyMapDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;

class GetObjectApiProxyMapCommand
{

    private ObjectProxyConfigService $object_proxy_config_service;
    private ProxyConfigService $proxy_config_service;


    private function __construct(
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service
    ) {
        $this->proxy_config_service = $proxy_config_service;
        $this->object_proxy_config_service = $object_proxy_config_service;
    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        ObjectProxyConfigService $object_proxy_config_service
    ) : /*static*/ self
    {
        return new static(
            $proxy_config_service,
            $object_proxy_config_service
        );
    }


    public function getObjectApiProxyMap(?ObjectDto $object, ?UserDto $user) : ?ObjectApiProxyMapDto
    {
        if ($object === null || $user === null) {
            return null;
        }

        if (!$this->proxy_config_service->isEnableObjectApiProxy()) {
            return null;
        }

        if (!$this->object_proxy_config_service->hasAccessToObjectProxy(
            $object,
            $user
        )
        ) {
            return null;
        }

        $key = $this->object_proxy_config_service->getObjectApiProxyMapKey(
            $object->id
        );
        if ($key === null) {
            return null;
        }

        return $this->proxy_config_service->getObjectApiProxyMapByKey(
            $key
        );
    }
}
