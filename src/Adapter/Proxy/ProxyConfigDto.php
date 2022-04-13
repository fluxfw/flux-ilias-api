<?php

namespace FluxIliasApi\Adapter\Proxy;

class ProxyConfigDto
{

    /**
     * @var string[]
     */
    private array $api_map;
    /**
     * @var string[]
     */
    private array $web_map;


    /**
     * @param string[] $api_map
     * @param string[] $web_map
     */
    private function __construct(
        /*private readonly*/ array $api_map,
        /*private readonly*/ array $web_map
    ) {
        $this->api_map = $api_map;
        $this->web_map = $web_map;
    }


    /**
     * @param string[]|null $api_map
     * @param string[]|null $web_map
     */
    public static function new(
        ?array $api_map = null,
        ?array $web_map = null
    ) : /*static*/ self
    {
        return new static(
            $api_map ?? [],
            $web_map ?? []
        );
    }


    public static function newFromEnv() : /*static*/ self
    {
        $api_map = [];
        foreach ($_ENV as $key => $value) {
            if (!str_starts_with($key, "FLUX_ILIAS_API_PROXY_API_MAP_")) {
                continue;
            }

            $api_map[strtolower(substr($key, 29))] = $value;
        }

        $web_map = [];
        foreach ($_ENV as $key => $value) {
            if (!str_starts_with($key, "FLUX_ILIAS_API_PROXY_WEB_MAP_")) {
                continue;
            }

            $web_map[strtolower(substr($key, 29))] = $value;
        }

        return static::new(
            $api_map,
            $web_map
        );
    }


    /**
     * @return string[]
     */
    public function getApiMap() : array
    {
        return $this->api_map;
    }


    /**
     * @return string[]
     */
    public function getWebMap() : array
    {
        return $this->web_map;
    }
}
