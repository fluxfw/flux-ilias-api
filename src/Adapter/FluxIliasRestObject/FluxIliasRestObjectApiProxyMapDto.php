<?php

namespace FluxIliasApi\Adapter\FluxIliasRestObject;

class FluxIliasRestObjectApiProxyMapDto
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
        object $api_proxy_map
    ) : /*static*/ self
    {
        return static::new(
            $api_proxy_map->key ?? "",
            $api_proxy_map->url ?? ""
        );
    }
}
