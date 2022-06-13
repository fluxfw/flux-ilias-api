<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectWebProxyLinkCommand
{

    private FluxIliasRestObjectService $flux_ilias_rest_object_service;


    private function __construct(
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : /*static*/ self
    {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function getFluxIliasRestObjectWebProxyLink(?FluxIliasRestObjectDto $object, ?UserDto $user) : string
    {
        $web_proxy_map = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMap(
            $object,
            $user
        );

        if ($web_proxy_map !== null) {
            $rewrite_url = $web_proxy_map->rewrite_url;
        } else {
            $rewrite_url = null;

            if ($object !== null
                && $this->flux_ilias_rest_object_service->hasAccessToFluxIliasRestObjectConfigForm(
                    $object->ref_id,
                    $user
                )
            ) {
                return $this->flux_ilias_rest_object_service->getFluxIliasRestObjectConfigLink(
                    $object->ref_id
                );
            }
        }

        return str_replace("%ref_id%", $object->ref_id, ($rewrite_url ?? "flux-ilias-rest-object-web-proxy/%ref_id%"));
    }
}
