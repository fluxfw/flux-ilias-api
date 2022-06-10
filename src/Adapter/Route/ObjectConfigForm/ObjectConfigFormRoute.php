<?php

namespace FluxIliasApi\Adapter\Route\ObjectConfigForm;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Channel\Object\ObjectQuery;
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

class ObjectConfigFormRoute implements Route
{

    use ObjectQuery;

    private ilGlobalTemplateInterface $ilias_global_template;
    private ilLocatorGUI $ilias_locator;
    private ObjectDto $object;
    private ProxyService $proxy_service;


    private function __construct(
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template,
        /*private readonly*/ ilLocatorGUI $ilias_locator,
        /*private readonly*/ ObjectDto $object
    ) {
        $this->proxy_service = $proxy_service;
        $this->ilias_global_template = $ilias_global_template;
        $this->ilias_locator = $ilias_locator;
        $this->object = $object;
    }


    public static function new(
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator,
        ObjectDto $object
    ) : /*static*/ self
    {
        return new static(
            $proxy_service,
            $ilias_global_template,
            $ilias_locator,
            $object
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
        $this->ilias_locator->addItem($this->object->title, $this->getObjectUrl(
            $this->object->ref_id
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
