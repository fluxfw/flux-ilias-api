<?php

namespace FluxIliasApi\Adapter\Route\FluxIliasRestObjectForm;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Channel\Proxy\Port\ProxyService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use ilGlobalTemplateInterface;
use ilLocatorGUI;

class FluxIliasRestObjectConfigFormRoute implements Route
{

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;
    private ilGlobalTemplateInterface $ilias_global_template;
    private ilLocatorGUI $ilias_locator;
    private FluxIliasRestObjectDto $object;
    private ProxyService $proxy_service;
    private UserDto $user;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service,
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template,
        /*private readonly*/ ilLocatorGUI $ilias_locator,
        /*private readonly*/ FluxIliasRestObjectDto $object,
        /*private readonly*/ UserDto $user
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
        $this->proxy_service = $proxy_service;
        $this->ilias_global_template = $ilias_global_template;
        $this->ilias_locator = $ilias_locator;
        $this->object = $object;
        $this->user = $user;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator,
        FluxIliasRestObjectDto $object,
        UserDto $user
    ) : /*static*/ self
    {
        return new static(
            $flux_ilias_rest_object_service,
            $proxy_service,
            $ilias_global_template,
            $ilias_locator,
            $object,
            $user
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
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
        $this->ilias_locator->addRepositoryItems($this->object->ref_id);
        $this->ilias_locator->addItem($this->object->title, $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyLink(
            $this->object->ref_id,
            $this->object->id,
            $this->user->id
        ));

        return ServerResponseDto::new(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    "flux-ilias-rest-object-config",
                    "flux-ilias-rest-object-config",
                    "flux-ilias-rest",
                    "object-config",
                    "/static/flilre_object_config.html",
                    [
                        "ref_id" => $this->object->ref_id
                    ],
                    $request->original_route
                )
            )
        );
    }
}
