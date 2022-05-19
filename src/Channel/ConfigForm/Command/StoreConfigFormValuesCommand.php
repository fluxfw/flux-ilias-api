<?php

namespace FluxIliasApi\Channel\ConfigForm\Command;

use FluxIliasApi\Adapter\CronConfig\CustomScheduleTypeCronConfig;
use FluxIliasApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasApi\Channel\Change\Port\ChangeService;
use FluxIliasApi\Channel\Config\LegacyConfigKey;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Channel\RestConfig\Port\RestConfigService;

class StoreConfigFormValuesCommand
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


    public function storeConfigFormValues(object $values) : bool
    {
        $this->proxy_config_service->setApiProxyMap(
            array_map([ApiProxyMapDto::class, "newFromData"], (array) ($values->{LegacyConfigKey::API_PROXY_MAP()->value} ?? null))
        );

        $this->proxy_config_service->setEnableApiProxy(
            boolval($values->{LegacyConfigKey::ENABLE_API_PROXY()->value} ?? null)
        );

        $this->change_service->setEnableLogChanges(
            boolval($values->{LegacyConfigKey::ENABLE_LOG_CHANGES()->value} ?? null)
        );

        $this->change_service->setEnablePurgeChanges(
            boolval($values->{LegacyConfigKey::ENABLE_PURGE_CHANGES()->value} ?? null)
        );

        $this->rest_config_service->setEnableRestApi(
            boolval($values->{LegacyConfigKey::ENABLE_REST_API()->value} ?? null)
        );

        $this->change_service->setEnableTransferChanges(
            boolval($values->{LegacyConfigKey::ENABLE_TRANSFER_CHANGES()->value} ?? null)
        );

        $this->proxy_config_service->setEnableWebProxy(
            boolval($values->{LegacyConfigKey::ENABLE_WEB_PROXY()->value} ?? null)
        );

        $this->change_service->setKeepChangesInsideDays(
            intval($values->{LegacyConfigKey::KEEP_CHANGES_INSIDE_DAYS()->value} ?? null)
        );

        $this->change_service->setPurgeChangesSchedule(
            CustomScheduleTypeCronConfig::factory($values->{LegacyConfigKey::PURGE_CHANGES_SCHEDULE()->value}->type ?? null),
            ($interval = $values->{LegacyConfigKey::PURGE_CHANGES_SCHEDULE()->value}->interval ?? null) !== null ? intval($interval) : null
        );

        $this->change_service->setTransferChangesPostUrl(
            strval($values->{LegacyConfigKey::TRANSFER_CHANGES_POST_URL()->value} ?? null)
        );

        $this->change_service->setTransferChangesSchedule(
            CustomScheduleTypeCronConfig::factory($values->{LegacyConfigKey::TRANSFER_CHANGES_SCHEDULE()->value}->type ?? null),
            ($interval = $values->{LegacyConfigKey::TRANSFER_CHANGES_SCHEDULE()->value}->interval ?? null) !== null ? intval($interval) : null
        );

        $this->proxy_config_service->setWebProxyMap(
            array_map([WebProxyMapDto::class, "newFromData"], (array) ($values->{LegacyConfigKey::WEB_PROXY_MAP()->value} ?? null))
        );

        return true;
    }
}
