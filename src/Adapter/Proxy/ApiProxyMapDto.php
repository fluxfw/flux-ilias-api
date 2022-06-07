<?php

namespace FluxIliasApi\Adapter\Proxy;

class ApiProxyMapDto
{

    public string $target_key;
    public string $url;


    private function __construct(
        /*public readonly*/ string $target_key,
        /*public readonly*/ string $url
    ) {
        $this->target_key = $target_key;
        $this->url = $url;
    }


    public static function new(
        string $target_key,
        string $url
    ) : /*static*/ self
    {
        return new static(
            $target_key,
            $url
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->target_key ?? "",
            $data->url ?? ""
        );
    }
}
