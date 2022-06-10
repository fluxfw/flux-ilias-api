<?php

namespace FluxIliasApi\Channel\ObjectConfigForm\Port;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\ObjectConfigForm\Command\GetObjectConfigFormValuesCommand;
use FluxIliasApi\Channel\ObjectConfigForm\Command\HasAccessToObjectConfigFormCommand;
use FluxIliasApi\Channel\ObjectConfigForm\Command\StoreObjectConfigFormValuesCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Port\ObjectProxyConfigService;
use ilAccessHandler;

class ObjectConfigFormService
{

    private ilAccessHandler $ilias_access;
    private ObjectProxyConfigService $object_proxy_config_service;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectProxyConfigService $object_proxy_config_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ilAccessHandler $ilias_access
    ) {
        $this->object_proxy_config_service = $object_proxy_config_service;
        $this->object_service = $object_service;
        $this->ilias_access = $ilias_access;
    }


    public static function new(
        ObjectProxyConfigService $object_proxy_config_service,
        ObjectService $object_service,
        ilAccessHandler $ilias_access
    ) : /*static*/ self
    {
        return new static(
            $object_proxy_config_service,
            $object_service,
            $ilias_access
        );
    }


    public function getObjectConfigFormValues(ObjectDto $object) : object
    {
        return GetObjectConfigFormValuesCommand::new(
            $this->object_proxy_config_service
        )
            ->getObjectConfigFormValues(
                $object
            );
    }


    public function hasAccessToObjectConfigForm(?ObjectDto $object, ?UserDto $user) : bool
    {
        return HasAccessToObjectConfigFormCommand::new(
            $this->ilias_access
        )
            ->hasAccessToObjectConfigForm(
                $object,
                $user
            );
    }


    public function storeObjectConfigFormValues(ObjectDto $object, object $values) : bool
    {
        return StoreObjectConfigFormValuesCommand::new(
            $this->object_proxy_config_service,
            $this->object_service
        )
            ->storeObjectConfigFormValues(
                $object,
                $values
            );
    }
}
