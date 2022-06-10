<?php

namespace FluxIliasApi\Channel\ObjectProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;

class GetObjectWebProxyMapSelectionCommand
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


    public function getObjectWebProxyMapSelection(int $id) : object
    {
        return (object) [
            "value"  => $this->object_proxy_config_service->getObjectWebProxyMapKey(
                $id
            ),
            "values" => array_map(fn(ObjectWebProxyMapDto $object_web_proxy_map) : string => $object_web_proxy_map->key, $this->proxy_config_service->getObjectWebProxyMap())
        ];
    }
}
