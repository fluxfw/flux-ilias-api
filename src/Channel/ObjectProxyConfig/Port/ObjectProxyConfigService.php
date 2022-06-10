<?php

namespace FluxIliasApi\Channel\ObjectProxyConfig\Port;

use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\Proxy\ObjectApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\ObjectWebProxyMapDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ObjectConfig\Port\ObjectConfigService;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectApiProxyMapCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectApiProxyMapKeyCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectApiProxyMapSelectionCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectWebProxyMapCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectWebProxyMapKeyCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\GetObjectWebProxyMapSelectionCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\HasAccessToObjectProxyCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\SetObjectApiProxyMapKeyCommand;
use FluxIliasApi\Channel\ObjectProxyConfig\Command\SetObjectWebProxyMapKeyCommand;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use ilAccessHandler;

class ObjectProxyConfigService
{

    private ilAccessHandler $ilias_access;
    private ObjectConfigService $object_config_service;
    private ProxyConfigService $proxy_config_service;


    private function __construct(
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ ObjectConfigService $object_config_service,
        /*private readonly*/ ilAccessHandler $ilias_access
    ) {
        $this->proxy_config_service = $proxy_config_service;
        $this->object_config_service = $object_config_service;
        $this->ilias_access = $ilias_access;
    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        ObjectConfigService $object_config_service,
        ilAccessHandler $ilias_access
    ) : /*static*/ self
    {
        return new static(
            $proxy_config_service,
            $object_config_service,
            $ilias_access
        );
    }


    public function getObjectApiProxyMap(?ObjectDto $object, ?UserDto $user) : ?ObjectApiProxyMapDto
    {
        return GetObjectApiProxyMapCommand::new(
            $this->proxy_config_service,
            $this
        )
            ->getObjectApiProxyMap(
                $object,
                $user
            );
    }


    public function getObjectApiProxyMapKey(int $id) : ?string
    {
        return GetObjectApiProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->getObjectApiProxyMapKey(
                $id
            );
    }


    public function getObjectApiProxyMapSelection(int $id) : object
    {
        return GetObjectApiProxyMapSelectionCommand::new(
            $this->proxy_config_service,
            $this
        )
            ->getObjectApiProxyMapSelection(
                $id
            );
    }


    public function getObjectWebProxyMap(?ObjectDto $object, ?UserDto $user) : ?ObjectWebProxyMapDto
    {
        return GetObjectWebProxyMapCommand::new(
            $this->proxy_config_service,
            $this
        )
            ->getObjectWebProxyMap(
                $object,
                $user
            );
    }


    public function getObjectWebProxyMapKey(int $id) : ?string
    {
        return GetObjectWebProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->getObjectWebProxyMapKey(
                $id
            );
    }


    public function getObjectWebProxyMapSelection(int $id) : object
    {
        return GetObjectWebProxyMapSelectionCommand::new(
            $this->proxy_config_service,
            $this
        )
            ->getObjectWebProxyMapSelection(
                $id
            );
    }


    public function hasAccessToObjectProxy(?ObjectDto $object, ?UserDto $user) : bool
    {
        return HasAccessToObjectProxyCommand::new(
            $this->ilias_access
        )
            ->hasAccessToObjectProxy(
                $object,
                $user
            );
    }


    public function setObjectApiProxyMapKey(int $id, string $key) : void
    {
        SetObjectApiProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->setObjectApiProxyMapKey(
                $id,
                $key
            );
    }


    public function setObjectWebProxyMapKey(int $id, string $key) : void
    {
        SetObjectWebProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->setObjectWebProxyMapKey(
                $id,
                $key
            );
    }
}
