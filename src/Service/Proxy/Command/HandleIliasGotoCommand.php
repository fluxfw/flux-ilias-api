<?php

namespace FluxIliasApi\Service\Proxy\Command;

use FluxIliasApi\Adapter\Authorization\ConfigForm\ConfigFormAuthorization;
use FluxIliasApi\Adapter\Route\ConfigForm\ConfigFormRouteCollector;
use FluxIliasApi\Adapter\Route\FluxIliasRestObjectForm\FluxIliasRestObjectConfigFormRouteCollector;
use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Authorization\Authorization;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\BodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Route\Collector\RouteCollector;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\DefaultStatus;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\Status;
use FluxIliasApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasApi\Service\Proxy\Port\ProxyService;
use FluxIliasApi\Service\Proxy\ProxyTarget;
use FluxIliasApi\Service\ProxyConfig\Port\ProxyConfigService;
use ilGlobalTemplateInterface;
use ilLocatorGUI;
use Throwable;

class HandleIliasGotoCommand
{

    private function __construct(
        private readonly ProxyService $proxy_service,
        private readonly ProxyConfigService $proxy_config_service,
        private readonly RestApi $rest_api,
        private readonly ConfigFormService $config_form_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ilGlobalTemplateInterface $ilias_global_template,
        private readonly ilLocatorGUI $ilias_locator
    ) {

    }


    public static function new(
        ProxyService $proxy_service,
        ProxyConfigService $proxy_config_service,
        RestApi $rest_api,
        ConfigFormService $config_form_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator
    ) : static {
        return new static(
            $proxy_service,
            $proxy_config_service,
            $rest_api,
            $config_form_service,
            $flux_ilias_rest_object_service,
            $ilias_global_template,
            $ilias_locator
        );
    }


    public function handleIliasGoto(?UserDto $user) : void
    {
        $request = $this->rest_api->getDefaultRequest();

        try {
            $target = $request->getQueryParam(
                "target"
            );
            switch (true) {
                case $target === ProxyTarget::CONFIG->value:
                    $this->handleConfig(
                        $user,
                        $request
                    );
                    break;

                case str_starts_with($target, ProxyTarget::API_PROXY->value):
                    $this->handleApiProxy(
                        $user,
                        $request,
                        substr($target, 17)
                    );
                    break;

                case str_starts_with($target, ProxyTarget::OBJECT_CONFIG->value):
                    $this->handleObjectConfig(
                        $user,
                        $request,
                        substr($target, 21)
                    );
                    break;

                case str_starts_with($target, ProxyTarget::OBJECT_API_PROXY->value):
                    $this->handleObjectApiProxy(
                        $user,
                        $request,
                        substr($target, 24)
                    );
                    break;

                case str_starts_with($target, ProxyTarget::OBJECT_WEB_PROXY->value):
                    $this->handleObjectWebProxy(
                        $user,
                        $request,
                        substr($target, 24)
                    );
                    break;

                case str_starts_with($target, ProxyTarget::WEB_PROXY->value):
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
                    DefaultStatus::_500
                ),
                $request->server_type
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
                $raw_body->body,
                $status,
                [
                    DefaultHeaderKey::CONTENT_TYPE->value => $raw_body->type
                ]
            ),
            $request->server_type
        );
    }


    private function getQueryParams(ServerRawRequestDto $request) : array
    {
        $query_params = $request->query_params;

        unset($query_params["baseClass"]);
        unset($query_params["client_id"]);
        unset($query_params["cmd"]);
        unset($query_params["cmdClass"]);
        unset($query_params["cmdNode"]);
        unset($query_params["lang"]);
        unset($query_params["limit"]);
        unset($query_params["ref_id"]);
        unset($query_params["route"]);
        unset($query_params["target"]);
        unset($query_params["view"]);

        return $query_params;
    }


    private function handleApiProxy(?UserDto $user, ServerRawRequestDto $request, string $target_key) : void
    {
        if ($user === null) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "Authorization in ILIAS needed"
                ),
                $request,
                DefaultStatus::_401
            );

            exit;
        }

        if (($api_proxy_map = $this->proxy_config_service->getApiProxyMapByKey(
                $target_key
            )) === null
        ) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "No access"
                ),
                $request,
                DefaultStatus::_403
            );

            exit;
        }

        $response = $this->rest_api->handleMethodOverride(
            $request
        );
        if ($response instanceof ServerResponseDto) {
            $this->bodyResponse(
                $response->body,
                $request,
                $response->status
            );

            exit;
        }
        $request = $response ?? $request;

        $response = $this->rest_api->makeRequest(
            ClientRequestDto::new(
                rtrim($api_proxy_map->url, "/") . (!empty($route = trim($request->getQueryParam(
                    "route"
                ), "/")) ? "/" . $route : ""),
                $request->method,
                $this->getQueryParams(
                    $request
                ),
                $request->body,
                [
                    DefaultHeaderKey::USER_AGENT->value => "flux-ilias-api",
                    "X-Flux-Ilias-Api-User-Id"          => $user->id,
                    "X-Flux-Ilias-Api-User-Import-Id"   => $user->import_id ?? ""
                ] + array_filter($request->headers, fn(string $key) : bool => in_array($target_key, [
                    DefaultHeaderKey::ACCEPT->value,
                    DefaultHeaderKey::CONTENT_TYPE->value
                ]), ARRAY_FILTER_USE_KEY),
                null,
                null,
                null,
                true,
                false,
                true,
                false
            )
        );

        $this->rest_api->handleDefaultResponse(
            ServerRawResponseDto::new(
                $response->raw_body,
                $response->status,
                array_filter($response->headers, fn(string $key) : bool => in_array($target_key, [
                    DefaultHeaderKey::CONTENT_TYPE->value
                ]), ARRAY_FILTER_USE_KEY)
            ),
            $request->server_type
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
                $this->ilias_global_template
            ),
            ConfigFormAuthorization::new(
                $this->config_form_service,
                $user
            )
        );
    }


    private function handleObjectApiProxy(?UserDto $user, ServerRawRequestDto $request, int $ref_id) : void
    {
        $object = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByRefId(
            $ref_id
        );

        if ($object === null || $user === null
            || ($api_proxy_map = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMap(
                $object,
                $user->id
            )) === null
        ) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "No access"
                ),
                $request,
                DefaultStatus::_403
            );

            exit;
        }

        $response = $this->rest_api->handleMethodOverride(
            $request
        );
        if ($response instanceof ServerResponseDto) {
            $this->bodyResponse(
                $response->body,
                $request,
                $response->status
            );

            exit;
        }
        $request = $response ?? $request;

        $response = $this->rest_api->makeRequest(
            ClientRequestDto::new(
                rtrim($api_proxy_map->url, "/") . (!empty($route = trim($request->getQueryParam(
                    "route"
                ), "/")) ? "/" . $route : ""),
                $request->method,
                $this->getQueryParams(
                    $request
                ),
                $request->body,
                [
                    DefaultHeaderKey::USER_AGENT->value => "flux-ilias-api",
                    "X-Flux-Ilias-Api-Object-Id"        => $object->id ?? "",
                    "X-Flux-Ilias-Api-Object-Import-Id" => $object->import_id ?? "",
                    "X-Flux-Ilias-Api-Object-Ref-Id"    => $object->ref_id ?? "",
                    "X-Flux-Ilias-Api-User-Id"          => $user->id,
                    "X-Flux-Ilias-Api-User-Import-Id"   => $user->import_id ?? ""
                ] + array_filter($request->headers, fn(string $key) : bool => in_array($key, [
                    DefaultHeaderKey::ACCEPT->value,
                    DefaultHeaderKey::CONTENT_TYPE->value
                ]), ARRAY_FILTER_USE_KEY),
                null,
                null,
                null,
                true,
                false,
                true,
                false
            )
        );

        $this->rest_api->handleDefaultResponse(
            ServerRawResponseDto::new(
                $response->raw_body,
                $response->status,
                array_filter($response->headers, fn(string $key) : bool => in_array($key, [
                    DefaultHeaderKey::CONTENT_TYPE->value
                ]), ARRAY_FILTER_USE_KEY)
            ),
            $request->server_type
        );

        exit;
    }


    private function handleObjectConfig(?UserDto $user, ServerRawRequestDto $request, int $ref_id) : void
    {
        $object = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByRefId(
            $ref_id
        );

        if ($object === null || $user === null
            || !$this->flux_ilias_rest_object_service->hasAccessToFluxIliasRestObjectConfigForm(
                $object->ref_id,
                $user->id
            )
        ) {
            return;
        }

        $this->handleRequest(
            $request,
            FluxIliasRestObjectConfigFormRouteCollector::new(
                $this->flux_ilias_rest_object_service,
                $this->proxy_service,
                $this->ilias_global_template,
                $this->ilias_locator,
                $object
            )
        );
    }


    private function handleObjectWebProxy(?UserDto $user, ServerRawRequestDto $request, int $ref_id) : void
    {
        $object = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByRefId(
            $ref_id
        );

        if ($object === null || $user === null
            || ($web_proxy_map = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMap(
                $object,
                $user->id
            )) === null
        ) {
            return;
        }

        $this->ilias_locator->addRepositoryItems($object->ref_id);
        $this->ilias_locator->addItem($object->title, $link = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyLink(
            $object->ref_id,
            $object->id
        ));

        $this->bodyResponse(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    $web_proxy_map->iframe_url,
                    $web_proxy_map->page_title,
                    $web_proxy_map->short_title,
                    $web_proxy_map->view_title,
                    $request->getQueryParam(
                        "route"
                    ),
                    ($web_proxy_map->pass_ref_id ? [
                        "ref_id" => $object->ref_id
                    ] : []) + $this->getQueryParams(
                        $request
                    ),
                    $request->original_route,
                    $link
                )
            ),
            $request
        );

        exit;
    }


    private function handleRequest(ServerRawRequestDto $request, RouteCollector $route_collector, ?Authorization $authorization = null) : void
    {
        $this->rest_api->handleDefaultResponse(
            $this->rest_api->handleRequest(
                ServerRawRequestDto::new(
                    "/" . trim($request->getQueryParam(
                        "route"
                    ), "/"),
                    $request->original_route,
                    $request->method,
                    $request->server_type,
                    $this->getQueryParams(
                        $request
                    ),
                    $request->body,
                    $request->post,
                    $request->files,
                    $request->headers,
                    $request->cookies
                ),
                $route_collector,
                $authorization
            ),
            $request->server_type
        );

        exit;
    }


    private function handleWebProxy(?UserDto $user, ServerRawRequestDto $request, string $target_key) : void
    {
        if (($web_proxy_map = $this->proxy_config_service->getWebProxyMapByKey(
                $target_key
            )) === null
        ) {
            return;
        }

        if (!$web_proxy_map->visible_public_menu_item && $user === null) {
            return;
        }

        $this->bodyResponse(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    $web_proxy_map->iframe_url,
                    $web_proxy_map->page_title,
                    $web_proxy_map->short_title,
                    $web_proxy_map->view_title,
                    $request->getQueryParam(
                        "route"
                    ),
                    $this->getQueryParams(
                        $request
                    ),
                    $request->original_route,
                    $web_proxy_map->getRewriteUrlWithDefault()
                )
            ),
            $request
        );

        exit;
    }
}
