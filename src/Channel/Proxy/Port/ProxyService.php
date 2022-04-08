<?php

namespace FluxIliasApi\Channel\Proxy\Port;

use FluxIliasApi\Adapter\Proxy\ProxyConfigDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Proxy\Command\HandleIliasGotoCommand;
use FluxIliasApi\Channel\Proxy\Command\HandleIliasRedirectCommand;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use ilGlobalTemplateInterface;

class ProxyService
{

    private ProxyConfigDto $proxy_config;
    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ ProxyConfigDto $proxy_config,
        /*private readonly*/ RestApi $rest_api
    ) {
        $this->proxy_config = $proxy_config;
        $this->rest_api = $rest_api;
    }


    public static function new(
        ProxyConfigDto $proxy_config,
        RestApi $rest_api
    ) : /*static*/ self
    {
        return new static(
            $proxy_config,
            $rest_api
        );
    }


    public function handleIliasGoto(ilGlobalTemplateInterface $ilias_global_template, ?UserDto $user) : void
    {
        HandleIliasGotoCommand::new(
            $this->proxy_config,
            $this->rest_api,
            $ilias_global_template
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
