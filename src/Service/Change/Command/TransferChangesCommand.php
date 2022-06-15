<?php

namespace FluxIliasApi\Service\Change\Command;

use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Header\LegacyDefaultHeaderKey;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasApi\Service\Change\ChangeQuery;
use FluxIliasApi\Service\Change\Port\ChangeService;
use ilDBInterface;

class TransferChangesCommand
{

    use ChangeQuery;

    private ChangeService $change_service;
    private ilDBInterface $ilias_database;
    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ RestApi $rest_api
    ) {
        $this->ilias_database = $ilias_database;
        $this->change_service = $change_service;
        $this->rest_api = $rest_api;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service,
        RestApi $rest_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $change_service,
            $rest_api
        );
    }


    public function transferChanges() : ?int
    {
        if (empty($this->change_service->getTransferChangesPostUrl())) {
            return null;
        }

        $changes = $this->change_service->getChanges(
            null,
            null,
            $this->change_service->getLastTransferredChangeTime()
        );

        $this->rest_api->makeRequest(
            ClientRequestDto::new(
                $this->change_service->getTransferChangesPostUrl(),
                LegacyDefaultMethod::POST(),
                null,
                json_encode($changes, JSON_UNESCAPED_SLASHES),
                [
                    LegacyDefaultHeaderKey::CONTENT_TYPE()->value => LegacyDefaultBodyType::JSON()->value,
                    LegacyDefaultHeaderKey::USER_AGENT()->value   => "flux-ilias-api"
                ],
                false,
                true,
                false,
                false
            )
        );

        $count = count($changes);
        if ($count > 0) {
            $this->change_service->setLastTransferredChangeTime(
                $changes[$count - 1]->time
            );
        }

        return $count;
    }
}
