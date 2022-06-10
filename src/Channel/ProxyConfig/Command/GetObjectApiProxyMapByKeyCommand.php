<?php

namespace FluxIliasApi\Channel\ProxyConfig\Command;

use FluxIliasApi\Adapter\Proxy\ObjectApiProxyMapDto;

class GetObjectApiProxyMapByKeyCommand
{

    /**
     * @var ObjectApiProxyMapDto[]
     */
    private array $object_api_proxy_map;


    /**
     * @param ObjectApiProxyMapDto[] $object_api_proxy_map
     */
    private function __construct(
        /*private readonly*/ array $object_api_proxy_map
    ) {
        $this->object_api_proxy_map = $object_api_proxy_map;
    }


    /**
     * @param ObjectApiProxyMapDto[] $object_api_proxy_map
     */
    public static function new(
        array $object_api_proxy_map
    ) : /*static*/ self
    {
        return new static(
            $object_api_proxy_map
        );
    }


    public function getObjectApiProxyMapByKey(string $key) : ?ObjectApiProxyMapDto
    {
        foreach ($this->object_api_proxy_map as $object_api_proxy_map_dto) {
            if ($object_api_proxy_map_dto->key === $key) {
                return $object_api_proxy_map_dto;
            }
        }

        return null;
    }
}
