<?php

namespace FluxIliasApi\Channel\ConfigForm\Command;

use FluxIliasApi\Channel\Change\Port\ChangeService;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Channel\RestConfig\Port\RestConfigService;

class GetConfigFormValuesCommand
{

    private ChangeService $change_service;
    private ProxyConfigService $proxy_config_service;
    private RestConfigService $rest_config_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ RestConfigService $rest_config_service
    ) {
        $this->change_service = $change_service;
        $this->proxy_config_service = $proxy_config_service;
        $this->rest_config_service = $rest_config_service;
    }


    public static function new(
        ChangeService $change_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $proxy_config_service,
            $rest_config_service
        );
    }


    public function getConfigFormValues() : object
    {
        return (object) [
            LegacyConfigKey::API_PROXY_MAP()->value                  => $this->proxy_config_service->getApiProxyMap(),
            LegacyConfigKey::ENABLE_API_PROXY()->value               => $this->proxy_config_service->isEnableApiProxy(),
            LegacyConfigKey::ENABLE_LOG_CHANGES()->value             => $this->change_service->isEnableLogChanges(),
            LegacyConfigKey::ENABLE_PURGE_CHANGES()->value           => $this->change_service->isEnablePurgeChanges(),
            LegacyConfigKey::ENABLE_REST_API()->value                => $this->rest_config_service->isEnableRestApi(),
            LegacyConfigKey::ENABLE_TRANSFER_CHANGES()->value        => $this->change_service->isEnableTransferChanges(),
            LegacyConfigKey::ENABLE_WEB_PROXY()->value               => $this->proxy_config_service->isEnableWebProxy(),
            LegacyConfigKey::KEEP_CHANGES_INSIDE_DAYS()->value       => $this->change_service->getKeepChangesInsideDays(),
            LegacyConfigKey::PURGE_CHANGES_SCHEDULE()->value         => $this->change_service->getPurgeChangesSchedule(),
            LegacyConfigKey::TRANSFER_CHANGES_POST_URL()->value      => $this->change_service->getTransferChangesPostUrl(),
            LegacyConfigKey::TRANSFER_CHANGES_SCHEDULE()->value      => $this->change_service->getTransferChangesSchedule(),
            LegacyConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET()->value => $this->proxy_config_service->getWebProxyIframeHeightOffset(),
            LegacyConfigKey::WEB_PROXY_MAP()->value                  => $this->proxy_config_service->getWebProxyMap()
        ];
    }
}
