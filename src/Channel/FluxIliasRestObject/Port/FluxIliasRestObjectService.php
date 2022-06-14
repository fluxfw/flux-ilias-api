<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Port;

use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\CreateFluxIliasRestObjectCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapByKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectApiProxyMapSelectionCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectConfigFormValuesCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectConfigLinkCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectDefaultIconUrlCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectMultipleTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebIconUrlCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebMultipleTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyLinkCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapByKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebProxyMapSelectionCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\GetFluxIliasRestObjectWebTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\HasAccessToFluxIliasRestObjectConfigFormCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\HasAccessToFluxIliasRestObjectProxyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectApiProxyMapKeyCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectApiProxyMapsCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectDefaultIconUrlCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectMultipleTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectTypeTitleCommand;
use FluxIliasApi\Channel\FluxIliasRestObject\Command\SetFluxIliasRestObjectWebProxyMapKeyCommand;
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
            $this,
            $this->object_service,
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
            $this,
            $this->object_service,
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
            $this,
            $this->object_service,
            $this->ilias_database
        )
            ->createFluxIliasRestObjectToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getFluxIliasRestObjectApiProxyMap(FluxIliasRestObjectDto $object, int $user_id) : ?FluxIliasRestObjectApiProxyMapDto
    {
        return GetFluxIliasRestObjectApiProxyMapCommand::new(
            $this
        )
            ->getFluxIliasRestObjectApiProxyMap(
                $object,
                $user_id
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


    public function getFluxIliasRestObjectApiProxyMapKey(int $id) : ?string
    {
        return GetFluxIliasRestObjectApiProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->getFluxIliasRestObjectApiProxyMapKey(
                $id
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
            $this,
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
            $this,
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
            $this,
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


    public function getFluxIliasRestObjectDefaultIconUrl() : ?string
    {
        return GetFluxIliasRestObjectDefaultIconUrlCommand::new(
            $this->config_service
        )
            ->getFluxIliasRestObjectDefaultIconUrl();
    }


    public function getFluxIliasRestObjectMultipleTypeTitle() : ?string
    {
        return GetFluxIliasRestObjectMultipleTypeTitleCommand::new(
            $this->config_service
        )
            ->getFluxIliasRestObjectMultipleTypeTitle();
    }


    public function getFluxIliasRestObjectTypeTitle() : ?string
    {
        return GetFluxIliasRestObjectTypeTitleCommand::new(
            $this->config_service
        )
            ->getFluxIliasRestObjectTypeTitle();
    }


    public function getFluxIliasRestObjectWebIconUrl(?int $id = null) : string
    {
        return GetFluxIliasRestObjectWebIconUrlCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebIconUrl(
                $id
            );
    }


    public function getFluxIliasRestObjectWebMultipleTypeTitle() : string
    {
        return GetFluxIliasRestObjectWebMultipleTypeTitleCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebMultipleTypeTitle();
    }


    public function getFluxIliasRestObjectWebProxyLink(int $ref_id, int $id, ?int $user_id = null) : string
    {
        return GetFluxIliasRestObjectWebProxyLinkCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebProxyLink(
                $ref_id,
                $id,
                $user_id
            );
    }


    public function getFluxIliasRestObjectWebProxyMap(FluxIliasRestObjectDto $object, int $user_id) : ?FluxIliasRestObjectWebProxyMapDto
    {
        return GetFluxIliasRestObjectWebProxyMapCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebProxyMap(
                $object,
                $user_id
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


    public function getFluxIliasRestObjectWebProxyMapKey(int $id) : ?string
    {
        return GetFluxIliasRestObjectWebProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->getFluxIliasRestObjectWebProxyMapKey(
                $id
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


    public function getFluxIliasRestObjectWebTypeTitle() : string
    {
        return GetFluxIliasRestObjectWebTypeTitleCommand::new(
            $this
        )
            ->getFluxIliasRestObjectWebTypeTitle();
    }


    /**
     * @return FluxIliasRestObjectDto[]
     */
    public function getFluxIliasRestObjects(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        return GetFluxIliasRestObjectsCommand::new(
            $this,
            $this->ilias_database
        )
            ->getFluxIliasRestObjects(
                $container_settings,
                $in_trash
            );
    }


    public function hasAccessToFluxIliasRestObjectConfigForm(int $ref_id, int $user_id) : bool
    {
        return HasAccessToFluxIliasRestObjectConfigFormCommand::new(
            $this->ilias_access
        )
            ->hasAccessToFluxIliasRestObjectConfigForm(
                $ref_id,
                $user_id
            );
    }


    public function hasAccessToFluxIliasRestObjectProxy(int $ref_id, int $user_id) : bool
    {
        return HasAccessToFluxIliasRestObjectProxyCommand::new(
            $this->ilias_access
        )
            ->hasAccessToFluxIliasRestObjectProxy(
                $ref_id,
                $user_id
            );
    }


    public function setFluxIliasRestObjectApiProxyMapKey(int $id, ?string $api_proxy_map_key) : void
    {
        SetFluxIliasRestObjectApiProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->setFluxIliasRestObjectApiProxyMapKey(
                $id,
                $api_proxy_map_key
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


    public function setFluxIliasRestObjectDefaultIconUrl(?string $default_icon_url) : void
    {
        SetFluxIliasRestObjectDefaultIconUrlCommand::new(
            $this->config_service
        )
            ->setFluxIliasRestObjectDefaultIconUrl(
                $default_icon_url
            );
    }


    public function setFluxIliasRestObjectMultipleTypeTitle(?string $multiple_type_title) : void
    {
        SetFluxIliasRestObjectMultipleTypeTitleCommand::new(
            $this->config_service
        )
            ->setFluxIliasRestObjectMultipleTypeTitle(
                $multiple_type_title
            );
    }


    public function setFluxIliasRestObjectTypeTitle(?string $type_title) : void
    {
        SetFluxIliasRestObjectTypeTitleCommand::new(
            $this->config_service
        )
            ->setFluxIliasRestObjectTypeTitle(
                $type_title
            );
    }


    public function setFluxIliasRestObjectWebProxyMapKey(int $id, ?string $web_proxy_map_key) : void
    {
        SetFluxIliasRestObjectWebProxyMapKeyCommand::new(
            $this->object_config_service
        )
            ->setFluxIliasRestObjectWebProxyMapKey(
                $id,
                $web_proxy_map_key
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
            $this->ilias_database
        )
            ->updateFluxIliasRestObjectByRefId(
                $ref_id,
                $diff
            );
    }
}
