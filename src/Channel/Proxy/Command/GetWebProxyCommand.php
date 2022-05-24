<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Channel\ProxyConfig\Port\ProxyConfigService;
use ilGlobalTemplateInterface;
use ILIAS\UICore\PageContentProvider;

class GetWebProxyCommand
{

    private ilGlobalTemplateInterface $ilias_global_template;
    private ProxyConfigService $proxy_config_service;


    private function __construct(
        /*private readonly*/ ProxyConfigService $proxy_config_service,
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template
    ) {
        $this->proxy_config_service = $proxy_config_service;
        $this->ilias_global_template = $ilias_global_template;
    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        ilGlobalTemplateInterface $ilias_global_template
    ) : /*static*/ self
    {
        return new static(
            $proxy_config_service,
            $ilias_global_template
        );
    }


    public function getWebProxy(
        string $url,
        ?string $page_title = null,
        ?string $short_title = null,
        ?string $view_title = null,
        ?string $route = null,
        ?array $query_params = null,
        ?string $original_route = null
    ) : string {
        $url = rtrim($url, "/") . (!empty($route = trim($route, "/")) ? "/" . $route : "");

        if (!empty($query_params)) {
            $url .= (str_contains($url, "?") ? "&" : "?") . implode("&",
                    array_map(fn(string $key, string $value) : string => rawurlencode($key) . "=" . rawurlencode($value), array_keys($query_params), $query_params));
        }

        $this->ilias_global_template->loadStandardTemplate();

        PageContentProvider::setTitle($page_title ?? "");
        PageContentProvider::setShortTitle($short_title ?? "");
        PageContentProvider::setViewTitle($view_title ?? "");

        $this->ilias_global_template->setContent("%CONTENT%");

        $html = $this->ilias_global_template->printToString();

        $html = str_replace("<head>", <<<EOL
            <head>
                <base href="/">
            EOL, $html);

        if (!str_ends_with($original_route, "/goto.php")) {
            $html = str_replace("/" . trim($original_route, "/") . "/", "/", $html);
        }

        $iframe_offset_height = htmlspecialchars($this->proxy_config_service->getWebProxyIframeHeightOffset() . "px");
        $src = htmlspecialchars($url);

        return str_replace("%CONTENT%", <<<EOL
            <link href="flux-ilias-rest-web-proxy/static/css/flilre_web_proxy.css" rel="stylesheet">
            <iframe id="flilre_web_proxy_iframe" src="$src" style="--FLUX_ILIAS_REST_WEB_PROXY_IFRAME_HEIGHT_OFFSET:$iframe_offset_height"></iframe>
            EOL, $html);
    }
}
