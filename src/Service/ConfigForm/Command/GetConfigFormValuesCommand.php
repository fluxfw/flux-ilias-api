<?php

namespace FluxIliasApi\Service\ConfigForm\Command;

use FluxIliasApi\Service\Change\Port\ChangeService;
use FluxIliasApi\Service\Config\ConfigKey;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Service\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Service\RestConfig\Port\RestConfigService;

class GetConfigFormValuesCommand
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ProxyConfigService $proxy_config_service,
        private readonly RestConfigService $rest_config_service
    ) {

    }


    public static function new(
        ChangeService $change_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service
    ) : static {
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
            ConfigKey::API_PROXY_MAP->value                              => $this->proxy_config_service->getApiProxyMap(),
            ConfigKey::ENABLE_API_PROXY->value                           => $this->proxy_config_service->isEnableApiProxy(),
            ConfigKey::ENABLE_LOG_CHANGES->value                         => $this->change_service->isEnableLogChanges(),
            ConfigKey::ENABLE_PURGE_CHANGES->value                       => $this->change_service->isEnablePurgeChanges(),
            ConfigKey::ENABLE_REST_API->value                            => $this->rest_config_service->isEnableRestApi(),
            ConfigKey::ENABLE_TRANSFER_CHANGES->value                    => $this->change_service->isEnableTransferChanges(),
            ConfigKey::ENABLE_WEB_PROXY->value                           => $this->proxy_config_service->isEnableWebProxy(),
            ConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS->value      => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMaps(),
            ConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL->value    => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectDefaultIconUrl(),
            ConfigKey::FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE->value => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectMultipleTypeTitle(),
            ConfigKey::FLUX_ILIAS_REST_OBJECT_TYPE_TITLE->value          => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectTypeTitle(),
            ConfigKey::FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS->value      => $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMaps(),
            ConfigKey::KEEP_CHANGES_INSIDE_DAYS->value                   => $this->change_service->getKeepChangesInsideDays(),
            ConfigKey::PURGE_CHANGES_SCHEDULE->value                     => $this->change_service->getPurgeChangesSchedule(),
            ConfigKey::TRANSFER_CHANGES_POST_URL->value                  => $this->change_service->getTransferChangesPostUrl(),
            ConfigKey::TRANSFER_CHANGES_SCHEDULE->value                  => $this->change_service->getTransferChangesSchedule(),
            ConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET->value             => $this->proxy_config_service->getWebProxyIframeHeightOffset(),
            ConfigKey::WEB_PROXY_MAP->value                              => $this->proxy_config_service->getWebProxyMap()
        ];
    }
}
