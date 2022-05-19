<?php

namespace FluxIliasApi\Channel\ConfigForm\Port;

use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Change\Port\ChangeService;
use FluxIliasApi\Channel\ConfigForm\Command\GetConfigFormMenuItemsCommand;
use FluxIliasApi\Channel\ConfigForm\Command\GetConfigFormValuesCommand;
use FluxIliasApi\Channel\ConfigForm\Command\HasAccessToConfigFormCommand;
use FluxIliasApi\Channel\ConfigForm\Command\StoreConfigFormValuesCommand;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Channel\RestConfig\Port\RestConfigService;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\Item\Link as MainMenuLink;

class ConfigFormService
{

    private ChangeService $change_service;
    private Container $ilias_dic;
    private ProxyConfigService $proxy_config_service;
    private RestConfigService $rest_config_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ RestConfigService $rest_config_service,
        /*private readonly*/ Container $ilias_dic
    ) {
        $this->change_service = $change_service;
        $this->proxy_config_service = $proxy_config_service;
        $this->rest_config_service = $rest_config_service;
        $this->ilias_dic = $ilias_dic;
    }


    public static function new(
        ChangeService $change_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service,
        Container $ilias_dic
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $proxy_config_service,
            $rest_config_service,
            $ilias_dic
        );
    }


    public function getConfigFormMenuItem(IdentificationProviderInterface $if, ?UserDto $user) : MainMenuLink
    {
        return GetConfigFormMenuItemsCommand::new(
            $this,
            $this->ilias_dic
        )
            ->getConfigFormMenuItem(
                $if,
                $user
            );
    }


    public function getConfigFormValues() : object
    {
        return GetConfigFormValuesCommand::new(
            $this->change_service,
            $this->proxy_config_service,
            $this->rest_config_service
        )
            ->getConfigFormValues();
    }


    public function hasAccessToConfigForm(?UserDto $user) : bool
    {
        return HasAccessToConfigFormCommand::new()
            ->hasAccessToConfigForm(
                $user
            );
    }


    public function storeConfigFormValues(object $values) : bool
    {
        return StoreConfigFormValuesCommand::new(
            $this->change_service,
            $this->proxy_config_service,
            $this->rest_config_service
        )
            ->storeConfigFormValues(
                $values
            );
    }
}
