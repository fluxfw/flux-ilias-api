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


    public function getWebProxy(string $title, string $url, ?string $route = null, ?array $query_params = null, ?string $original_route = null) : string
    {
        $url = rtrim($url, "/") . (!empty($route = trim($route, "/")) ? "/" . $route : "");

        if (!empty($query_params)) {
            $url .= (str_contains($url, "?") ? "&" : "?") . implode("&",
                    array_map(fn(string $key, string $value) : string => rawurlencode($key) . "=" . rawurlencode($value), array_keys($query_params), $query_params));
        }

        $this->ilias_global_template->loadStandardTemplate();

        PageContentProvider::setShortTitle($title);
        PageContentProvider::setViewTitle($title);
        PageContentProvider::setTitle($title);

        $this->ilias_global_template->setContent("%CONTENT%");

        $html = $this->ilias_global_template->printToString();

        $html = str_replace("<head>", '<head><base href="/">', $html);
        if (!str_ends_with($original_route, "/goto.php")) {
            $html = str_replace("/" . trim($original_route, "/") . "/", "/", $html);
        }

        return str_replace("%CONTENT%",
            '<iframe style="border:none;height:calc(100vh - ' . $this->proxy_config_service->getWebProxyIframeHeightOffset() . 'px);width:100%;" src="' . htmlspecialchars($url) . '"></iframe>',
            $html);
    }
}
