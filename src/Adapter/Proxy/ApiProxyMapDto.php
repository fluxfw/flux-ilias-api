<?php

namespace FluxIliasApi\Adapter\Proxy;

use JsonSerializable;

class ApiProxyMapDto implements JsonSerializable
{

    private string $target_key;
    private string $url;


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


    public function getTargetKey() : string
    {
        return $this->target_key;
    }


    public function getUrl() : string
    {
        return $this->url;
    }


    public function jsonSerialize() : object
    {
        return (object) get_object_vars($this);
    }
}
