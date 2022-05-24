<?php

namespace FluxIliasApi\Adapter\Proxy;

use FluxIliasApi\Channel\Proxy\LegacyProxyTarget;
use JsonSerializable;

class WebProxyMapDto implements JsonSerializable
{

    private string $iframe_url;
    private bool $menu_item;
    private ?string $menu_title;
    private string $page_title;
    private ?string $rewrite_url;
    private string $short_title;
    private string $target_key;
    private string $view_title;
    private bool $visible_public_menu_item;


    private function __construct(
        /*public readonly*/ string $target_key,
        /*public readonly*/ string $iframe_url,
        /*public readonly*/ string $page_title,
        /*public readonly*/ string $short_title,
        /*public readonly*/ string $view_title,
        /*public readonly*/ ?string $rewrite_url,
        /*public readonly*/ bool $menu_item,
        /*public readonly*/ ?string $menu_title,
        /*public readonly*/ bool $visible_public_menu_item
    ) {
        $this->target_key = $target_key;
        $this->iframe_url = $iframe_url;
        $this->page_title = $page_title;
        $this->short_title = $short_title;
        $this->view_title = $view_title;
        $this->rewrite_url = $rewrite_url;
        $this->menu_item = $menu_item;
        $this->menu_title = $menu_title;
        $this->visible_public_menu_item = $visible_public_menu_item;
    }


    public static function new(
        string $target_key,
        string $iframe_url,
        string $page_title,
        string $short_title,
        string $view_title,
        ?string $rewrite_url,
        ?bool $menu_item,
        ?string $menu_title,
        ?bool $visible_public_menu_item
    ) : /*static*/ self
    {
        return new static(
            $target_key,
            $iframe_url,
            $page_title,
            $short_title,
            $view_title,
            $rewrite_url,
            $menu_item ?? false,
            $menu_title,
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
            $data->page_title ?? "",
            $data->short_title ?? "",
            $data->view_title ?? "",
            ($data->rewrite_url ?? null) ?: null,
            $data->menu_item ?? null,
            ($data->menu_title ?? null) ?: null,
            $data->visible_public_menu_item ?? null
        );
    }


    public function getIframeUrl() : string
    {
        return $this->iframe_url;
    }


    public function getMenuTitle() : string
    {
        return $this->menu_title ?? "";
    }


    public function getMenuTitleWithDefault() : string
    {
        return $this->menu_title ?? $this->target_key;
    }


    public function getPageTitle() : string
    {
        return $this->page_title;
    }


    public function getRewriteUrl() : string
    {
        return $this->rewrite_url ?? "";
    }


    public function getRewriteUrlWithDefault() : string
    {
        return $this->rewrite_url ?? "/goto.php?target=" . LegacyProxyTarget::WEB_PROXY()->value . $this->target_key;
    }


    public function getShortTitle() : string
    {
        return $this->short_title;
    }


    public function getTargetKey() : string
    {
        return $this->target_key;
    }


    public function getViewTitle() : string
    {
        return $this->view_title;
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
