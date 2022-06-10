<?php

namespace FluxIliasApi\Channel\ObjectConfigForm\Command;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;

class GetObjectConfigFormValuesCommand
{

    private ObjectProxyConfigService $object_proxy_config_service;


    private function __construct(
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service
    ) {
        $this->object_proxy_config_service = $object_proxy_config_service;
    }


    public static function new(
        ObjectProxyConfigService $object_proxy_config_service
    ) : /*static*/ self
    {
        return new static(
            $object_proxy_config_service
        );
    }


    public function getObjectConfigFormValues(ObjectDto $object) : object
    {
        return (object) [
            LegacyObjectConfigKey::API_PROXY_MAP_KEY()->value => $this->object_proxy_config_service->getObjectApiProxyMapSelection(
                $object->id
            ),
            "description"                                     => $object->description,
            LegacyObjectConfigKey::WEB_PROXY_MAP_KEY()->value => $this->object_proxy_config_service->getObjectWebProxyMapSelection(
                $object->id
            ),
            "title"                                           => $object->title
        ];
    }
}
