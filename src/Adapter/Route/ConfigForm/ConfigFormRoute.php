<?php

namespace FluxIliasApi\Adapter\Route\ConfigForm;

use FluxIliasApi\Channel\Proxy\Port\ProxyService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use ilGlobalTemplateInterface;

class ConfigFormRoute implements Route
{

    private ilGlobalTemplateInterface $ilias_global_template;
    private string $original_route;
    private ProxyService $proxy_service;


    private function __construct(
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template,
        /*private readonly*/ string $original_route
    ) {
        $this->proxy_service = $proxy_service;
        $this->ilias_global_template = $ilias_global_template;
        $this->original_route = $original_route;
    }


    public static function new(
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        string $original_route
    ) : /*static*/ self
    {
        return new static(
            $proxy_service,
            $ilias_global_template,
            $original_route
        );
    }


    public function getDocuRequestBodyTypes() : ?array
    {
        return null;
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    "flux-ilias-rest-config",
                    "flux-ilias-rest-config",
                    "/static/flilre_config.html",
                    null,
                    $this->original_route
                )
            )
        );
    }
}
