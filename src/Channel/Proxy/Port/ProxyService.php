<?php

namespace FluxIliasApi\Channel\Proxy\Port;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\ObjectConfigForm\Port\ObjectConfigFormService;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;
use FluxIliasApi\Channel\Proxy\Command\GetObjectConfigLinkCommand;
use FluxIliasApi\Channel\Proxy\Command\GetObjectWebProxyLinkCommand;
use FluxIliasApi\Channel\Proxy\Command\GetWebProxyCommand;
use FluxIliasApi\Channel\Proxy\Command\GetWebProxyMenuItemsCommand;
use FluxIliasApi\Channel\Proxy\Command\HandleIliasGotoCommand;
use FluxIliasApi\Channel\Proxy\Command\HandleIliasRedirectCommand;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use ilGlobalTemplateInterface;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ilLocatorGUI;

class ProxyService
{

    private ConfigFormService $config_form_service;
    private Container $ilias_dic;
    private ObjectConfigFormService $object_config_form_service;
    private ObjectProxyConfigService $object_proxy_config_service;
    private ObjectService $object_service;
    private ProxyConfigService $proxy_config_service;
    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ RestApi $rest_api,
        /*private readonly*/ ConfigFormService $config_form_service,
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ObjectConfigFormService $object_config_form_service,
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service,
        /*private readonly*/ Container $ilias_dic
    ) {
        $this->rest_api = $rest_api;
        $this->config_form_service = $config_form_service;
        $this->proxy_config_service = $proxy_config_service;
        $this->object_service = $object_service;
        $this->object_config_form_service = $object_config_form_service;
        $this->object_proxy_config_service = $object_proxy_config_service;
        $this->ilias_dic = $ilias_dic;
    }


    public static function new(
        RestApi $rest_api,
        ConfigFormService $config_form_service,
        ProxyConfigService $proxy_config_service,
        ObjectService $object_service,
        ObjectConfigFormService $object_config_form_service,
        ObjectProxyConfigService $object_proxy_config_service,
        Container $ilias_dic
    ) : /*static*/ self
    {
        return new static(
            $rest_api,
            $config_form_service,
            $proxy_config_service,
            $object_service,
            $object_config_form_service,
            $object_proxy_config_service,
            $ilias_dic
        );
    }


    public function getObjectConfigLink(int $ref_id) : string
    {
        return GetObjectConfigLinkCommand::new()
            ->getObjectConfigLink(
                $ref_id
            );
    }


    public function getObjectWebProxyLink(?ObjectDto $object, ?UserDto $user) : string
    {
        return GetObjectWebProxyLinkCommand::new(
            $this->object_config_form_service,
            $this->object_proxy_config_service,
            $this
        )
            ->getObjectWebProxyLink(
                $object,
                $user
            );
    }


    public function getWebProxy(
        ilGlobalTemplateInterface $ilias_global_template,
        string $url,
        ?string $page_title = null,
        ?string $short_title = null,
        ?string $view_title = null,
        ?string $route = null,
        ?array $query_params = null,
        ?string $original_route = null
    ) : string {
        return GetWebProxyCommand::new(
            $this->proxy_config_service,
            $ilias_global_template
        )
            ->getWebProxy(
                $url,
                $page_title,
                $short_title,
                $view_title,
                $route,
                $query_params,
                $original_route
            );
    }


    public function getWebProxyMenuItems(IdentificationProviderInterface $if, ?UserDto $user) : array
    {
        return GetWebProxyMenuItemsCommand::new(
            $this->proxy_config_service,
            $this->ilias_dic
        )
            ->getWebProxyMenuItems(
                $if,
                $user
            );
    }


    public function handleIliasGoto(ilGlobalTemplateInterface $ilias_global_template, ilLocatorGUI $ilias_locator, ?UserDto $user) : void
    {
        HandleIliasGotoCommand::new(
            $this,
            $this->proxy_config_service,
            $this->rest_api,
            $this->config_form_service,
            $this->object_service,
            $this->object_config_form_service,
            $this->object_proxy_config_service,
            $ilias_global_template,
            $ilias_locator
        )
            ->handleIliasGoto(
                $user
            );
    }


    public function handleIliasRedirect(string $url) : ?string
    {
        return HandleIliasRedirectCommand::new(
            $this->rest_api
        )
            ->handleIliasRedirect(
                $url
            );
    }
}
