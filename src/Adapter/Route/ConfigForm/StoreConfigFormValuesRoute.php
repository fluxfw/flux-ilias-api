<?php

namespace FluxIliasApi\Adapter\Route\ConfigForm;

use FluxIliasApi\Channel\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class StoreConfigFormValuesRoute implements Route
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
        return [
            LegacyDefaultBodyType::JSON()
        ];
    }


    public function getDocuRequestQueryParams() : ?array
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
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                LegacyDefaultStatus::_400()
            );
        }

        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->config_form_service->storeConfigFormValues(
                    $request->getParsedBody()->getData()
                )
            )
        );
    }
}