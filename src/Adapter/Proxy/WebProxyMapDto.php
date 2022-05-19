<?php

namespace FluxIliasApi\Adapter\Proxy;

use FluxIliasApi\Channel\Proxy\LegacyProxyTarget;
use JsonSerializable;

class WebProxyMapDto implements JsonSerializable
{

    private string $iframe_url;
    private bool $menu_item;
    private ?string $rewrite_url;
    private string $target_key;
    private ?string $title;
    private bool $visible_public_menu_item;


    private function __construct(
        /*public readonly*/ string $target_key,
        /*public readonly*/ string $iframe_url,
        /*public readonly*/ string $title,
        /*public readonly*/ string $rewrite_url,
        /*public readonly*/ bool $menu_item,
        /*public readonly*/ bool $visible_public_menu_item
    ) {
        $this->target_key = $target_key;
        $this->iframe_url = $iframe_url;
        $this->title = $title;
        $this->rewrite_url = $rewrite_url;
        $this->menu_item = $menu_item;
        $this->visible_public_menu_item = $visible_public_menu_item;
    }


    public static function new(
        string $target_key,
        string $iframe_url,
        ?string $title = null,
        ?string $rewrite_url = null,
        ?bool $menu_item = null,
        ?bool $visible_public_menu_item = null
    ) : /*static*/ self
    {
        return new static(
            $target_key,
            $iframe_url,
            $title,
            $rewrite_url,
            $menu_item ?? false,
            $visible_public_menu_item ?? false
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->target_key ?? "",
            $data->iframe_url ?? "",
            $data->title ?: null,
            $data->rewrite_url ?: null,
            $data->menu_item ?? null,
            $data->visible_public_menu_item ?? null
        );
    }


    public function getIframeUrl() : string
    {
        return $this->iframe_url;
    }


    public function getRewriteUrl() : ?string
    {
        return $this->rewrite_url;
    }


    public function getRewriteUrl2() : string
    {
        return $this->rewrite_url ?? "/goto.php?target=" . LegacyProxyTarget::WEB_PROXY()->value . $this->target_key;
    }


    public function getTargetKey() : string
    {
        return $this->target_key;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getTitle2() : string
    {
        return $this->title ?? $this->target_key;
    }


    public function isMenuItem() : bool
    {
        return $this->menu_item;
    }


    public function isVisiblePublicMenuItem() : bool
    {
        return $this->visible_public_menu_item;
    }


    public function jsonSerialize() : object
    {
        return (object) get_object_vars($this);
    }
}
