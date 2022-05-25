<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Proxy\LegacyProxyTarget;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\UI\Component\Symbol\Icon\Standard;

class GetWebProxyMenuItemsCommand
{

    private Container $ilias_dic;
    private ProxyConfigService $proxy_config_service;


    private function __construct(
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ Container $ilias_dic
    ) {
        $this->proxy_config_service = $proxy_config_service;
        $this->ilias_dic = $ilias_dic;
    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        Container $ilias_dic
    ) : /*static*/ self
    {
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
            $menu_items[] = $this->ilias_dic->globalScreen()->mainBar()->link($if->identifier(LegacyProxyTarget::WEB_PROXY()->value . $web_proxy_map->getTargetKey()))
                ->withPosition(42100 + $i)
                ->withTitle($web_proxy_map->getMenuTitleWithDefault())
                ->withAction($web_proxy_map->getRewriteUrlWithDefault())
                ->withSymbol($this->ilias_dic->ui()->factory()->symbol()->icon()->standard(Standard::WEBR, $web_proxy_map->getMenuTitleWithDefault())->withIsOutlined(true))
                ->withAvailableCallable(fn() : bool => $this->proxy_config_service->isEnableWebProxy() && $web_proxy_map->isMenuItem())
                ->withVisibilityCallable(fn() : bool => $web_proxy_map->isVisiblePublicMenuItem() || $user !== null);
        }

        return $menu_items;
    }
}
