<?php

namespace FluxIliasApi\Channel\ConfigForm\Command;

use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Channel\Proxy\LegacyProxyTarget;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\Item\Link as MainMenuLink;
use ILIAS\MainMenu\Provider\StandardTopItemsProvider;
use ILIAS\UI\Component\Symbol\Icon\Standard;

class GetConfigFormMenuItemsCommand
{

    private ConfigFormService $config_form_service;
    private Container $ilias_dic;


    private function __construct(
        /*private readonly*/ ConfigFormService $config_form_service,
        /*private readonly*/ Container $ilias_dic
    ) {
        $this->config_form_service = $config_form_service;
        $this->ilias_dic = $ilias_dic;
    }


    public static function new(
        ConfigFormService $config_form_service,
        Container $ilias_dic
    ) : /*static*/ self
    {
        return new static(
            $config_form_service,
            $ilias_dic
        );
    }


    public function getConfigFormMenuItem(IdentificationProviderInterface $if, ?UserDto $user) : MainMenuLink
    {
        return $this->ilias_dic->globalScreen()->mainBar()->link($if->identifier(LegacyProxyTarget::CONFIG()->value))
            ->withParent(StandardTopItemsProvider::getInstance()->getAdministrationIdentification())
            ->withPosition(42001)
            ->withTitle("flux-ilias-rest-config")
            ->withAction("flux-ilias-rest-config")
            ->withSymbol($this->ilias_dic->ui()->factory()->symbol()->icon()->standard(Standard::ADM, "flux-ilias-rest-config")->withIsOutlined(true))
            ->withVisibilityCallable(fn() : bool => $this->config_form_service->hasAccessToConfigForm(
                $user
            ));
    }
}
