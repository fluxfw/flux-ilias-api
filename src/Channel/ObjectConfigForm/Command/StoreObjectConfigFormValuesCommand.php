<?php

namespace FluxIliasApi\Channel\ObjectConfigForm\Command;

use FluxIliasApi\Adapter\Object\ObjectDiffDto;
use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\ObjectConfig\LegacyObjectConfigKey;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;

class StoreObjectConfigFormValuesCommand
{

    private ObjectProxyConfigService $object_proxy_config_service;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->object_proxy_config_service = $object_proxy_config_service;
        $this->object_service = $object_service;
    }


    public static function new(
        ObjectProxyConfigService $object_proxy_config_service,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $object_proxy_config_service,
            $object_service
        );
    }


    public function storeObjectConfigFormValues(ObjectDto $object, object $values) : bool
    {
        $this->object_service->updateObjectById(
            $object->id,
            ObjectDiffDto::new(
                null,
                null,
                strval($values->title ?? null),
                strval($values->description ?? null)
            )
        );

        $this->object_proxy_config_service->setObjectApiProxyMapKey(
            $object->id,
            strval($values->{LegacyObjectConfigKey::API_PROXY_MAP_KEY()->value} ?? null)
        );

        $this->object_proxy_config_service->setObjectWebProxyMapKey(
            $object->id,
            strval($values->{LegacyObjectConfigKey::WEB_PROXY_MAP_KEY()->value} ?? null)
        );

        return true;
    }
}
