<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Adapter\Authorization\ConfigForm\ConfigFormAuthorization;
use FluxIliasApi\Adapter\Route\ConfigForm\ConfigFormRouteCollector;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Channel\Proxy\LegacyProxyTarget;
use FluxIliasApi\Channel\Proxy\Port\ProxyService;
use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Authorization\Authorization;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\BodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Header\LegacyDefaultHeaderKey;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Collector\RouteCollector;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\Status;
use ilGlobalTemplateInterface;
use Throwable;

class HandleIliasGotoCommand
{

    private ConfigFormService $config_form_service;
    private ilGlobalTemplateInterface $ilias_global_template;
    private ProxyConfigService $proxy_config_service;
    private ProxyService $proxy_service;
    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ ProxyService $proxy_service,
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ RestApi $rest_api,
        /*private readonly*/ ConfigFormService $config_form_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template
    ) {
        $this->proxy_service = $proxy_service;
        $this->proxy_config_service = $proxy_config_service;
        $this->rest_api = $rest_api;
        $this->config_form_service = $config_form_service;
        $this->ilias_global_template = $ilias_global_template;
    }


    public static function new(
        ProxyService $proxy_service,
        ProxyConfigService $proxy_config_service,
        RestApi $rest_api,
        ConfigFormService $config_form_service,
        ilGlobalTemplateInterface $ilias_global_template
    ) : /*static*/ self
    {
        return new static(
            $proxy_service,
            $proxy_config_service,
            $rest_api,
            $config_form_service,
            $ilias_global_template
        );
    }


    public function handleIliasGoto(?UserDto $user) : void
    {
        $request = $this->rest_api->getDefaultRequest(
            false
        );

        try {
            $target = $request->getQueryParam(
                "target"
            );
            switch (true) {
                case $target === LegacyProxyTarget::CONFIG()->value:
                    $this->handleConfig(
                        $user,
                        $request
                    );
                    break;

                case str_starts_with($target, LegacyProxyTarget::API_PROXY()->value):
                    $this->handleApiProxy(
                        $user,
                        $request,
                        substr($target, 17)
                    );
                    break;

                case str_starts_with($target, LegacyProxyTarget::WEB_PROXY()->value):
                    $this->handleWebProxy(
                        $user,
                        $request,
                        substr($target, 17)
                    );
                    break;

                default:
                    break;
            }
        } catch (Throwable $ex) {
            file_put_contents("php://stdout", $ex);

            $this->rest_api->handleDefaultResponse(
                ServerRawResponseDto::new(
                    null,
                    LegacyDefaultStatus::_500()
                ),
                $request->getServerType()
            );

            exit;
        }
    }


    private function bodyResponse(BodyDto $body, ServerRawRequestDto $request, ?Status $status = null) : void
    {
        $raw_body = $this->rest_api->toRawBody(
            $body
        );

        $this->rest_api->handleDefaultResponse(
            ServerRawResponseDto::new(
                $raw_body->getBody(),
                $status,
                [
                    LegacyDefaultHeaderKey::CONTENT_TYPE()->value => $raw_body->getType()
                ]
            ),
            $request->getServerType()
        );
    }


    private function getQueryParams(ServerRawRequestDto $request) : array
    {
        $query_params = $request->getQueryParams();

        unset($query_params["client_id"]);
        unset($query_params["lang"]);
        unset($query_params["limit"]);
        unset($query_params["route"]);
        unset($query_params["target"]);

        return $query_params;
    }


    private function handleApiProxy(?UserDto $user, ServerRawRequestDto $request, string $key) : void
    {
        if ($user === null) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "Authorization in ILIAS needed"
                ),
                $request,
                LegacyDefaultStatus::_401()
            );

            exit;
        }

        if (!$this->proxy_config_service->isEnableApiProxy()
            || ($api_proxy_map = $this->proxy_config_service->getApiProxyMapByKey(
                $key
            )) === null
        ) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "No access"
                ),
                $request,
                LegacyDefaultStatus::_403()
            );

            exit;
        }

        $response = $this->rest_api->handleMethodOverride(
            $request
        );
        if ($response instanceof ServerResponseDto) {
            $this->bodyResponse(
                $response->getBody(),
                $request,
                $response->getStatus()
            );

            exit;
        }
        $request = $response ?? $request;

        $response = $this->rest_api->makeRequest(
            ClientRequestDto::new(
                rtrim($api_proxy_map->getUrl(), "/") . (!empty($route = trim($request->getQueryParam(
                    "route"
                ), "/")) ? "/" . $route : ""),
                $request->getMethod(),
                $this->getQueryParams(
                    $request
                ),
                $request->getBody(),
                [
                    LegacyDefaultHeaderKey::USER_AGENT()->value => "flux-ilias-api",
                    "X-Flux-Ilias-Api-User-Id"                  => $user->getId(),
                    "X-Flux-Ilias-Api-User-Import-Id"           => $user->getImportId() ?? ""
                ] + array_filter($request->getHeaders(), fn(string $key) : bool => in_array($key, [
                    LegacyDefaultHeaderKey::ACCEPT()->value
                ]), ARRAY_FILTER_USE_KEY),
                true,
                false,
                true,
                false
            )
        );

        $this->rest_api->handleDefaultResponse(
            ServerRawResponseDto::new(
                $response->getBody(),
                $response->getStatus(),
                array_filter($response->getHeaders(), fn(string $key) : bool => in_array($key, [
                    LegacyDefaultHeaderKey::CONTENT_TYPE()->value
                ]), ARRAY_FILTER_USE_KEY)
            ),
            $request->getServerType()
        );

        exit;
    }


    private function handleConfig(?UserDto $user, ServerRawRequestDto $request) : void
    {
        $this->handleRequest(
            $request,
            ConfigFormRouteCollector::new(
                $this->config_form_service,
                $this->proxy_service,
                $this->ilias_global_template,
                $request->getRoute()
            ),
            ConfigFormAuthorization::new(
                $this->config_form_service,
                $user
            )
        );
    }


    private function handleRequest(ServerRawRequestDto $request, RouteCollector $route_collector, Authorization $authorization) : void
    {
        $this->rest_api->handleDefaultResponse(
            $this->rest_api->handleRequest(
                ServerRawRequestDto::new(
                    "/" . trim($request->getQueryParam(
                        "route"
                    ), "/"),
                    $request->getMethod(),
                    $request->getServerType(),
                    $this->getQueryParams(
                        $request
                    ),
                    $request->getBody(),
                    $request->getPost(),
                    $request->getFiles(),
                    $request->getHeaders(),
                    $request->getCookies()
                ),
                $route_collector,
                $authorization
            ),
            $request->getServerType()
        );

        exit;
    }


    private function handleWebProxy(?UserDto $user, ServerRawRequestDto $request, string $key) : void
    {
        if (!$this->proxy_config_service->isEnableWebProxy()
            || ($web_proxy_map = $this->proxy_config_service->getWebProxyMapByKey(
                $key
            )) === null
        ) {
            return;
        }

        if (!$web_proxy_map->isVisiblePublicMenuItem() && $user === null) {
            return;
        }

        $this->bodyResponse(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    $web_proxy_map->getIframeUrl(),
                    $web_proxy_map->getPageTitle(),
                    $web_proxy_map->getShortTitle(),
                    $web_proxy_map->getViewTitle(),
                    $request->getQueryParam(
                        "route"
                    ),
                    $this->getQueryParams(
                        $request
                    ),
                    $request->getRoute()
                )
            ),
            $request
        );

        exit;
    }
}
