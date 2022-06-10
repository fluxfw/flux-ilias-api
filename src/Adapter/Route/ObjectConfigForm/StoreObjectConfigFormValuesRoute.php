<?php

namespace FluxIliasApi\Adapter\Route\ObjectConfigForm;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Channel\ObjectConfigForm\Port\ObjectConfigFormService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class StoreObjectConfigFormValuesRoute implements Route
{

    private ObjectDto $object;
    private ObjectConfigFormService $object_config_form_service;


    private function __construct(
        /*private readonly*/ ObjectConfigFormService $object_config_form_service,
        /*private readonly*/ ObjectDto $object
    ) {
        $this->object_config_form_service = $object_config_form_service;
        $this->object = $object;
    }


    public static function new(
        ObjectConfigFormService $object_config_form_service,
        ObjectDto $object
    ) : /*static*/ self
    {
        return new static(
            $object_config_form_service,
            $object
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return null;
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::POST();
    }


    public function getRoute() : string
    {
        return "/store-values";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                LegacyDefaultStatus::_400()
            );
        }

        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->object_config_form_service->storeObjectConfigFormValues(
                    $this->object,
                    $request->parsed_body->data
                )
            )
        );
    }
}
