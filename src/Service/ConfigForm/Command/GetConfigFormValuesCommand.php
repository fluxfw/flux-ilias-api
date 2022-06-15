<?php

namespace FluxIliasApi\Service\ConfigForm\Command;

use FluxIliasApi\Service\Change\Port\ChangeService;
use FluxIliasApi\Service\Config\LegacyConfigKey;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Service\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Service\RestConfig\Port\RestConfigService;

class GetConfigFormValuesCommand
{

    private ChangeService $change_service;
    private FluxIliasRestObjectService $flux_ilias_rest_object_service;
    private ProxyConfigService $proxy_config_service;
    private RestConfigService $rest_config_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ FluxIliasRestObjectService $flux_ilias_rest_object_service,
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ RestConfigService $rest_config_service
    ) {
        $this->change_service = $change_service;
        $this->flux_ilias_rest_object_service = $flux_ilias_rest_object_service;
        $this->proxy_config_service = $proxy_config_service;
        $this->rest_config_service = $rest_config_service;
    }


    public static function new(
        ChangeService $change_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $flux_ilias_rest_object_service,
            $proxy_config_service,
            $rest_config_service
        );
    }


    public function getConfigFormValues() : object
    {
        return (object) [
            LegacyConfigKey::API_PROXY_MAP()->value                              => $this->proxy_config_service->getApiProxyMap(),
            LegacyConfigKey::ENABLE_API_PROXY()->value                           => $this->proxy_config_service->isEnableApiProxy(),
            LegacyConfigKey::ENABLE_LOG_CHANGES()->value                         => $this->change_service->isEnableLogChanges(),
            LegacyConfigKey::ENABLE_PURGE_CHANGES()->value                       => $this->change_service->isEnablePurgeChanges(),
            LegacyConfigKey::ENABLE_REST_API()->value                            => $this->rest_config_service->isEnableRestApi(),
            LegacyConfigKey::ENABLE_TRANSFER_CHANGES()->value                    => $this->change_service->isEnableTransferChanges(),
            LegacyConfigKey::ENABLE_WEB_PROXY()->value                           => $this->proxy_config_service->isEnableWebProxy(),
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS()->value      => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMaps(),
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL()->value    => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectDefaultIconUrl(),
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE()->value => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectMultipleTypeTitle(),
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_TYPE_TITLE()->value          => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectTypeTitle(),
            LegacyConfigKey::FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS()->value      => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMaps(),
            LegacyConfigKey::KEEP_CHANGES_INSIDE_DAYS()->value                   => $this->change_service->getKeepChangesInsideDays(),
            LegacyConfigKey::PURGE_CHANGES_SCHEDULE()->value                     => $this->change_service->getPurgeChangesSchedule(),
            LegacyConfigKey::TRANSFER_CHANGES_POST_URL()->value                  => $this->change_service->getTransferChangesPostUrl(),
            LegacyConfigKey::TRANSFER_CHANGES_SCHEDULE()->value                  => $this->change_service->getTransferChangesSchedule(),
            LegacyConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET()->value             => $this->proxy_config_service->getWebProxyIframeHeightOffset(),
            LegacyConfigKey::WEB_PROXY_MAP()->value                              => $this->proxy_config_service->getWebProxyMap()
        ];
    }
}
