<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Port;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\CreateFluxIliasRestObjectCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapByKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapSelectionCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectConfigFormValuesCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectConfigLinkCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyLinkCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapByKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapSelectionCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\HasAccessToFluxIliasRestObjectConfigFormCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\HasAccessToFluxIliasRestObjectProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\IsEnableFluxIliasRestObjectApiProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\IsEnableFluxIliasRestObjectWebProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetEnableFluxIliasRestObjectApiProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetEnableFluxIliasRestObjectWebProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectApiProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectWebProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\StoreFluxIliasRestObjectConfigFormValuesCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\UpdateFluxIliasRestObjectCommand;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\ObjectConfig\Port\ObjectConfigService;
use ilAccessHandler;
use ilDBInterface;

class FluxIliasRestObjectService
{

    private ConfigService $config_service;
    private ilAccessHandler $ilias_access;
    private ilDBInterface $ilias_database;
    private ObjectConfigService $object_config_service;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ObjectConfigService $object_config_service,
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ilAccessHandler $ilias_access
    ) {
        $this->config_service = $config_service;
        $this->object_service = $object_service;
        $this->object_config_service = $object_config_service;
        $this->ilias_database = $ilias_database;
        $this->ilias_access = $ilias_access;
    }


    public static function new(
        ConfigService $config_service,
        ObjectService $object_service,
        ObjectConfigService $object_config_service,
        ilDBInterface $ilias_database,
        ilAccessHandler $ilias_access
    ) : /*static*/ self
    {
        return new static(
            $config_service,
            $object_service,
            $object_config_service,
            $ilias_database,
            $ilias_access
        );
    }


    public function createFluxIliasRestObjectToId(int $parent_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFluxIliasRestObjectCommand::new(
            $this->object_service,
            $this->object_config_service,
            $this->ilias_database
        )
            ->createFluxIliasRestObjectToId(
                $parent_id,
                $diff
            );
    }


    public function createFluxIliasRestObjectToImportId(string $parent_import_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFluxIliasRestObjectCommand::new(
            $this->object_service,
            $this->object_config_service,
            $this->ilias_database
        )
            ->createFluxIliasRestObjectToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createFluxIliasRestObjectToRefId(int $parent_ref_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFluxIliasRestObjectCommand::new(
            $this->object_service,
            $this->object_config_service,
            $this->ilias_database
        )
            ->createFluxIliasRestObjectToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getFluxIliasRestObjectApiProxyMap(FluxIliasRestObjectDto $object, ?UserDto $user) : ?FluxIliasRestObjectApiProxyMapDto
    {
        return GetFluxIliasRestObjectApiProxyMapCommand::new(
            $this

        )
            ->getFluxIliasRestObjectApiProxyMap(
                $object,
                $user
            );
    }


    public function getFluxIliasRestObjectApiProxyMapByKey(string $key) : ?FluxIliasRestObjectApiProxyMapDto
    {
        return GetFluxIliasRestObjectApiProxyMapByKeyCommand::new(
            $this->getFluxIliasRestObjectApiProxyMaps()
        )
            ->getFluxIliasRestObjectApiProxyMapByKey(
                $key
            );
    }


    public function getFluxIliasRestObjectApiProxyMapSelection(FluxIliasRestObjectDto $object) : object
    {
        return GetFluxIliasRestObjectApiProxyMapSelectionCommand::new(
            $this
        )
            ->getFluxIliasRestObjectApiProxyMapSelection(
                $object
            );
    }


    /**
     * @return FluxIliasRestObjectApiProxyMapDto[]
     */
    public function getFluxIliasRestObjectApiProxyMaps() : array
    {
        return GetFluxIliasRestObjectApiProxyMapsCommand::new(
            $this->config_service
        )
            ->getFluxIliasRestObjectApiProxyMaps();
    }


    public function getFluxIliasRestObjectById(int $id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        return GetFluxIliasRestObjectCommand::new(
            $this->ilias_database
        )
            ->getFluxIliasRestObjectById(
                $id,
                $in_trash
            );
    }


    public function getFluxIliasRestObjectByImportId(string $import_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        return GetFluxIliasRestObjectCommand::new(
            $this->ilias_database
        )
            ->getFluxIliasRestObjectByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getFluxIliasRestObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        return GetFluxIliasRestObjectCommand::new(
            $this->ilias_database
        )
            ->getFluxIliasRestObjectByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getFluxIliasRestObjectConfigFormValues(FluxIliasRestObjectDto $object) : object
    {
        return GetFluxIliasRestObjectConfigFormValuesCommand::new(
            $this
        )
            ->getFluxIliasRestObjectConfigFormValues(
                $object
            );
    }


    public function getFluxIliasRestObjectConfigLink(int $ref_id) : string
    {
        return GetFluxIliasRestObjectConfigLinkCommand::new()
            ->getFluxIliasRestObjectConfigLink(
                $ref_id
            );
    }


    public function getFluxIliasRestObjectWebProxyLink(?FluxIliasRestObjectDto $object, ?UserDto $user) : string
    {
        return GetFluxIliasRestObjectWebProxyLinkCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebProxyLink(
                $object,
                $user
            );
    }


    public function getFluxIliasRestObjectWebProxyMap(FluxIliasRestObjectDto $object, ?UserDto $user) : ?FluxIliasRestObjectWebProxyMapDto
    {
        return GetFluxIliasRestObjectWebProxyMapCommand::new(
            $this

        )
            ->getFluxIliasRestObjectWebProxyMap(
                $object,
                $user
            );
    }


    public function getFluxIliasRestObjectWebProxyMapByKey(string $key) : ?FluxIliasRestObjectWebProxyMapDto
    {
        return GetFluxIliasRestObjectWebProxyMapByKeyCommand::new(
            $this->getFluxIliasRestObjectWebProxyMaps()
        )
            ->getFluxIliasRestObjectWebProxyMapByKey(
                $key
            );
    }


    public function getFluxIliasRestObjectWebProxyMapSelection(FluxIliasRestObjectDto $object) : object
    {
        return GetFluxIliasRestObjectWebProxyMapSelectionCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebProxyMapSelection(
                $object
            );
    }


    /**
     * @return FluxIliasRestObjectWebProxyMapDto[]
     */
    public function getFluxIliasRestObjectWebProxyMaps() : array
    {
        return GetFluxIliasRestObjectWebProxyMapsCommand::new(
            $this->config_service
        )
            ->getFluxIliasRestObjectWebProxyMaps();
    }


    /**
     * @return FluxIliasRestObjectDto[]
     */
    public function getFluxIliasRestObjects(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        return GetFluxIliasRestObjectsCommand::new(
            $this->ilias_database
        )
            ->getFluxIliasRestObjects(
                $container_settings,
                $in_trash
            );
    }


    public function hasAccessToFluxIliasRestObjectConfigForm(int $ref_id, ?UserDto $user) : bool
    {
        return HasAccessToFluxIliasRestObjectConfigFormCommand::new(
            $this->ilias_access
        )
            ->hasAccessToFluxIliasRestObjectConfigForm(
                $ref_id,
                $user
            );
    }


    public function hasAccessToFluxIliasRestObjectProxy(int $ref_id, ?UserDto $user) : bool
    {
        return HasAccessToFluxIliasRestObjectProxyCommand::new(
            $this->ilias_access
        )
            ->hasAccessToFluxIliasRestObjectProxy(
                $ref_id,
                $user
            );
    }


    public function isEnableFluxIliasRestObjectApiProxy() : bool
    {
        return IsEnableFluxIliasRestObjectApiProxyCommand::new(
            $this->config_service
        )
            ->isEnableFluxIliasRestObjectApiProxy();
    }


    public function isEnableFluxIliasRestObjectWebProxy() : bool
    {
        return IsEnableFluxIliasRestObjectWebProxyCommand::new(
            $this->config_service
        )
            ->isEnableFluxIliasRestObjectWebProxy();
    }


    public function setEnableFluxIliasRestObjectApiProxy(bool $enable_flux_ilias_rest_object_api_proxy) : void
    {
        SetEnableFluxIliasRestObjectApiProxyCommand::new(
            $this->config_service
        )
            ->setEnableFluxIliasRestObjectApiProxy(
                $enable_flux_ilias_rest_object_api_proxy
            );
    }


    public function setEnableFluxIliasRestObjectWebProxy(bool $enable_flux_ilias_rest_object_web_proxy) : void
    {
        SetEnableFluxIliasRestObjectWebProxyCommand::new(
            $this->config_service
        )
            ->setEnableFluxIliasRestObjectWebProxy(
                $enable_flux_ilias_rest_object_web_proxy
            );
    }


    /**
     * @param FluxIliasRestObjectApiProxyMapDto[] $api_proxy_maps
     */
    public function setFluxIliasRestObjectApiProxyMaps(array $api_proxy_maps) : void
    {
        SetFluxIliasRestObjectApiProxyMapsCommand::new(
            $this->config_service
        )
            ->setFluxIliasRestObjectApiProxyMaps(
                $api_proxy_maps
            );
    }


    /**
     * @param FluxIliasRestObjectWebProxyMapDto[] $web_proxy_maps
     */
    public function setFluxIliasRestObjectWebProxyMaps(array $web_proxy_maps) : void
    {
        SetFluxIliasRestObjectWebProxyMapsCommand::new(
            $this->config_service
        )
            ->setFluxIliasRestObjectWebProxyMaps(
                $web_proxy_maps
            );
    }


    public function storeFluxIliasRestObjectConfigFormValues(FluxIliasRestObjectDto $object, object $values) : bool
    {
        return StoreFluxIliasRestObjectConfigFormValuesCommand::new(
            $this
        )
            ->storeFluxIliasRestObjectConfigFormValues(
                $object,
                $values
            );
    }


    public function updateFluxIliasRestObjectById(int $id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFluxIliasRestObjectCommand::new(
            $this,
            $this->object_config_service,
            $this->ilias_database
        )
            ->updateFluxIliasRestObjectById(
                $id,
                $diff
            );
    }


    public function updateFluxIliasRestObjectByImportId(string $import_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFluxIliasRestObjectCommand::new(
            $this,
            $this->object_config_service,
            $this->ilias_database
        )
            ->updateFluxIliasRestObjectByImportId(
                $import_id,
                $diff
            );
    }


    public function updateFluxIliasRestObjectByRefId(int $ref_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFluxIliasRestObjectCommand::new(
            $this,
            $this->object_config_service,
            $this->ilias_database
        )
            ->updateFluxIliasRestObjectByRefId(
                $ref_id,
                $diff
            );
    }
}
