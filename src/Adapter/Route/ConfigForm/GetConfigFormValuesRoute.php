<?php

namespace FluxIliasApi\Adapter\Route\ConfigForm;

use FluxIliasApi\Channel\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;

class GetConfigFormValuesRoute implements Route
{

    private ConfigFormService $config_form_service;


    private function __construct(
        /*private readonly*/ ConfigFormService $config_form_service
    ) {
        $this->config_form_service = $config_form_service;
    }


    public static function new(
        ConfigFormService $config_form_service
    ) : /*static*/ self
    {
        return new static(
            $config_form_service
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
