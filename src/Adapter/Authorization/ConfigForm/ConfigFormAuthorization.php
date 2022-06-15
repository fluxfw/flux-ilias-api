<?php

namespace FluxIliasApi\Adapter\Authorization\ConfigForm;

use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Authorization\Authorization;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;
use FluxIliasApi\Service\ConfigForm\Port\ConfigFormService;

class ConfigFormAuthorization implements Authorization
{

    private ConfigFormService $config_form_service;
    private ?UserDto $user;


    private function __construct(
        /*private readonly*/ ConfigFormService $config_form_service,
        /*private readonly*/ ?UserDto $user
    ) {
        $this->config_form_service = $config_form_service;
        $this->user = $user;
    }


    public static function new(
        ConfigFormService $config_form_service,
        ?UserDto $user
    ) : /*static*/ self
    {
        return new static(
            $config_form_service,
            $user
        );
    }


    public function authorize(ServerRawRequestDto $request) : ?ServerResponseDto
    {
        if ($request->route === "/") {
            return null;
        }

        if ($this->user === null) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Authorization in ILIAS needed"
                ),
                LegacyDefaultStatus::_401()
            );
        }

        if (!$this->config_form_service->hasAccessToConfigForm(
            $this->user
        )
        ) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No access"
                ),
                LegacyDefaultStatus::_403()
            );
        }

        return null;
    }
}
