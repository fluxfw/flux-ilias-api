<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;

class GetFluxIliasRestObjectWebProxyMapByKeyCommand
{

    /**
     * @var FluxIliasRestObjectWebProxyMapDto[]
     */
    private array $web_proxy_maps;


    /**
     * @param FluxIliasRestObjectWebProxyMapDto[] $web_proxy_maps
     */
    private function __construct(
        /*private readonly*/ array $web_proxy_maps
    ) {
        $this->web_proxy_maps = $web_proxy_maps;
    }


    /**
     * @param FluxIliasRestObjectWebProxyMapDto[] $web_proxy_maps
     */
    public static function new(
        array $web_proxy_maps
    ) : static {
        return new static(
            $web_proxy_maps
        );
    }


    public function getFluxIliasRestObjectWebProxyMapByKey(string $key) : ?FluxIliasRestObjectWebProxyMapDto
    {
        foreach ($this->web_proxy_maps as $web_proxy_map) {
            if ($web_proxy_map->key === $key) {
                return $web_proxy_map;
            }
        }

        return null;
    }
}
