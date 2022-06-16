<?php

namespace FluxIliasApi\Service\Proxy\Command;

use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Service\Proxy\LegacyProxyTarget;
use FluxIliasApi\Service\ProxyConfig\Port\ProxyConfigService;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\UI\Component\Symbol\Icon\Standard;

class GetWebProxyMenuItemsCommand
{

    private function __construct(
        private readonly ProxyConfigService $proxy_config_service,
        private readonly Container $ilias_dic
    ) {

    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        Container $ilias_dic
    ) : static {
        return new static(
            $proxy_config_service,
            $ilias_dic
        );
    }


    public function getWebProxyMenuItems(IdentificationProviderInterface $if, ?UserDto $user) : array
    {
        $menu_items = [];

        $i = 0;
        foreach ($this->proxy_config_service->getWebProxyMap() as $web_proxy_map) {
            $menu_items[] = $this->ilias_dic->globalScreen()->mainBar()->link($if->identifier(LegacyProxyTarget::WEB_PROXY()->value . $web_proxy_map->target_key))
                ->withPosition(42100 + $i)
                ->withTitle($web_proxy_map->getMenuTitleWithDefault())
                ->withAction($web_proxy_map->getRewriteUrlWithDefault())
                ->withSymbol($web_proxy_map->menu_icon_url !== null
                    ? $this->ilias_dic->ui()
                        ->factory()
                        ->symbol()
                        ->icon()
                        ->custom($web_proxy_map->menu_icon_url, $web_proxy_map->getMenuTitleWithDefault())
                    : $this->ilias_dic->ui()
                        ->factory()
                        ->symbol()
                        ->icon()
                        ->standard(Standard::WEBR, $web_proxy_map->getMenuTitleWithDefault())
                        ->withIsOutlined(true))
                ->withAvailableCallable(fn() : bool => $this->proxy_config_service->isEnableWebProxy() && $web_proxy_map->menu_item)
                ->withVisibilityCallable(fn() : bool => $web_proxy_map->visible_public_menu_item || $user !== null);
        }

        return $menu_items;
    }
}
