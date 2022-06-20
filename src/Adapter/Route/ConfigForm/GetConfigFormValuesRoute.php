<?php

namespace FluxIliasApi\Adapter\Route\ConfigForm;

use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\DefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Service\ConfigForm\Port\ConfigFormService;

class GetConfigFormValuesRoute implements Route
{

    private function __construct(
        private readonly ConfigFormService $config_form_service
    ) {

    }


    public static function new(
        ConfigFormService $config_form_service
    ) : static {
        return new static(
            $config_form_service
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return null;
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/get-values";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->config_form_service->getConfigFormValues()
            )
        );
    }
}
