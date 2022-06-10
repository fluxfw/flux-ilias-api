<?php

namespace FluxIliasApi\Adapter\Proxy;

class ObjectWebProxyMapDto
{

    public string $iframe_url;
    public string $key;
    public string $page_title;
    public ?string $rewrite_url;
    public string $short_title;
    public string $view_title;


    private function __construct(
        /*public readonly*/ string $key,
        /*public readonly*/ string $iframe_url,
        /*public readonly*/ string $page_title,
        /*public readonly*/ string $short_title,
        /*public readonly*/ string $view_title,
        /*public readonly*/ ?string $rewrite_url
    ) {
        $this->key = $key;
        $this->iframe_url = $iframe_url;
        $this->page_title = $page_title;
        $this->short_title = $short_title;
        $this->view_title = $view_title;
        $this->rewrite_url = $rewrite_url;
    }


    public static function new(
        string $key,
        string $iframe_url,
        string $page_title,
        string $short_title,
        string $view_title,
        ?string $rewrite_url
    ) : /*static*/ self
    {
        return new static(
            $key,
            $iframe_url,
            $page_title,
            $short_title,
            $view_title,
            $rewrite_url
        );
    }


    public static function newFromObject(
        object $object_web_proxy_map
    ) : /*static*/ self
    {
        return static::new(
            $object_web_proxy_map->key ?? "",
            $object_web_proxy_map->iframe_url ?? "",
            $object_web_proxy_map->page_title ?? "",
            $object_web_proxy_map->short_title ?? "",
            $object_web_proxy_map->view_title ?? "",
            ($object_web_proxy_map->rewrite_url ?? null) ?: null
        );
    }
}
