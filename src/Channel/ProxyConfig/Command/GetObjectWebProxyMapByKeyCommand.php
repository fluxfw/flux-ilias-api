<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;

class GetObjectWebProxyMapByKeyCommand
{

    /**
     * @var ObjectWebProxyMapDto[]
     */
    private array $object_web_proxy_map;


    /**
     * @param ObjectWebProxyMapDto[] $object_web_proxy_map
     */
    private function __construct(
        /*private readonly*/ array $object_web_proxy_map
    ) {
        $this->object_web_proxy_map = $object_web_proxy_map;
    }


    /**
     * @param ObjectWebProxyMapDto[] $object_web_proxy_map
     */
    public static function new(
        array $object_web_proxy_map
    ) : /*static*/ self
    {
        return new static(
            $object_web_proxy_map
        );
    }


    public function getObjectWebProxyMapByKey(string $key) : ?ObjectWebProxyMapDto
    {
        foreach ($this->object_web_proxy_map as $object_web_proxy_map_dto) {
            if ($object_web_proxy_map_dto->key === $key) {
                return $object_web_proxy_map_dto;
            }
        }

        return null;
    }
}
