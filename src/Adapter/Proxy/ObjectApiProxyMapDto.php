<?php

namespace FluxIliasApi\Adapter\Proxy;

class ObjectApiProxyMapDto
{

    public string $key;
    public string $url;


    private function __construct(
        /*public readonly*/ string $key,
        /*public readonly*/ string $url
    ) {
        $this->key = $key;
        $this->url = $url;
    }


    public static function new(
        string $key,
        string $url
    ) : /*static*/ self
    {
        return new static(
            $key,
            $url
        );
    }


    public static function newFromObject(
        object $object_api_proxy_map
    ) : /*static*/ self
    {
        return static::new(
            $object_api_proxy_map->key ?? "",
            $object_api_proxy_map->url ?? ""
        );
    }
}
