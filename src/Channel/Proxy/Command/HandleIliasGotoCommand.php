<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Adapter\Proxy\ProxyConfigDto;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\BodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Header\LegacyDefaultHeader;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Status\Status;
use ilGlobalTemplateInterface;
use Throwable;

class HandleIliasGotoCommand
{

    private ilGlobalTemplateInterface $ilias_global_template;
    private ProxyConfigDto $proxy_config;
    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ ProxyConfigDto $proxy_config,
        /*private readonly*/ RestApi $rest_api,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template
    ) {
        $this->proxy_config = $proxy_config;
        $this->rest_api = $rest_api;
        $this->ilias_global_template = $ilias_global_template;
    }


    public static function new(
        ProxyConfigDto $proxy_config,
        RestApi $rest_api,
        ilGlobalTemplateInterface $ilias_global_template
    ) : /*static*/ self
    {
        return new static(
            $proxy_config,
            $rest_api,
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
                case str_starts_with($target, "flilre_api_proxy_"):
                    $this->handleApiProxy(
                        $user,
                        $request,
                        substr($target, 17)
                    );
                    break;

                case str_starts_with($target, "flilre_web_proxy_"):
                    $this->handleWebProxy(
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
                    LegacyDefaultHeader::CONTENT_TYPE()->value => $raw_body->getType()
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
                    "Authorization needed"
                ),
                $request,
                LegacyDefaultStatus::_401()
            );

            exit;
        }

        if (empty($url = $this->proxy_config->getApiMap()[$key] ?? null)) {
            $this->bodyResponse(
                TextBodyDto::new(
                    "Not found"
                ),
                $request,
                LegacyDefaultStatus::_404()
            );

            exit;
        }

        $response = $this->rest_api->makeRequest(
            ClientRequestDto::new(
                $url . (!empty($path = trim($request->getQueryParam(
                    "route"
                ), "/")) ? "/" . $path : ""),
                $request->getMethod(),
                $this->getQueryParams(
                    $request
                ),
                $request->getBody(),
                [
                    LegacyDefaultHeader::USER_AGENT()->value => "flux-ilias-api",
                    "X-Flux-Ilias-Api-User-Id"               => $user->getId(),
                    "X-Flux-Ilias-Api-User-Import-Id"        => $user->getImportId() ?? ""
                ] + array_filter($request->getHeaders(), fn(string $header) : bool => in_array($header, [
                    LegacyDefaultHeader::ACCEPT()->value
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
                array_filter($response->getHeaders(), fn(string $header) : bool => in_array($header, [
                    LegacyDefaultHeader::CONTENT_TYPE()->value
                ]), ARRAY_FILTER_USE_KEY)
            ),
            $request->getServerType()
        );

        exit;
    }


    private function handleWebProxy(ServerRawRequestDto $request, string $key) : void
    {
        if (empty($url = $this->proxy_config->getWebMap()[$key] ?? null)) {
            return;
        }

        $url = $url . (!empty($path = trim($request->getQueryParam(
                "route"
            ), "/")) ? "/" . $path : "");
        if (!empty($query_params = $this->getQueryParams(
            $request
        ))
        ) {
            $url .= (str_contains($url, "?") ? "&" : "?") . implode("&",
                    array_map(fn(string $key, string $value) : string => rawurlencode($key) . "=" . rawurlencode($value), array_keys($query_params), $query_params));
        }

        $this->ilias_global_template->loadStandardTemplate();

        $this->ilias_global_template->setContent('<iframe style="border:none;height:calc(100vh - 220px);width:100%;" src="' . htmlspecialchars($url) . '"></iframe>');

        $ilias_html = str_replace("<head>", '<head><base href="/">', $this->ilias_global_template->printToString());
        if (!str_ends_with($request->getRoute(), "/goto.php")) {
            $ilias_html = str_replace("/" . trim($request->getRoute(), "/") . "/", "/", $ilias_html);
        }

        $this->bodyResponse(
            HtmlBodyDto::new(
                $ilias_html
            ),
            $request
        );

        exit;
    }
}
