<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ObjectConfigForm\Port\ObjectConfigFormService;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;
use FluxIliasApi\Channel\Proxy\Port\ProxyService;

class GetObjectWebProxyLinkCommand
{

    private ObjectConfigFormService $object_config_form_service;
    private ObjectProxyConfigService $object_proxy_config_service;
    private ProxyService $proxy_service;


    private function __construct(
        /*private readonly*/ ObjectConfigFormService $object_config_form_service,
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service,
        /*private readonly*/ ProxyService $proxy_service
    ) {
        $this->object_config_form_service = $object_config_form_service;
        $this->object_proxy_config_service = $object_proxy_config_service;
        $this->proxy_service = $proxy_service;
    }


    public static function new(
        ObjectConfigFormService $object_config_form_service,
        ObjectProxyConfigService $object_proxy_config_service,
        ProxyService $proxy_service
    ) : /*static*/ self
    {
        return new static(
            $object_config_form_service,
            $object_proxy_config_service,
            $proxy_service
        );
    }


    public function getObjectWebProxyLink(?ObjectDto $object, ?UserDto $user) : string
    {
        $object_web_proxy_map = $this->object_proxy_config_service->getObjectWebProxyMap(
            $object,
            $user
        );

        if ($object_web_proxy_map !== null) {
            $rewrite_url = $object_web_proxy_map->rewrite_url;
        } else {
            $rewrite_url = null;

            if ($this->object_config_form_service->hasAccessToObjectConfigForm(
                $object,
                $user
            )
            ) {
                return $this->proxy_service->getObjectConfigLink(
                    $object->ref_id
                );
            }
        }

        return str_replace("%ref_id%", $object->ref_id, ($rewrite_url ?? "flux-ilias-rest-object-web-proxy/%ref_id%"));
    }
}
