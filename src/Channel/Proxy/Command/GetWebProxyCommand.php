<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use ilGlobalTemplateInterface;
use ILIAS\UICore\PageContentProvider;

class GetWebProxyCommand
{

    private ilGlobalTemplateInterface $ilias_global_template;


    private function __construct(
        /*private readonly*/ ilGlobalTemplateInterface $ilias_global_template
    ) {
        $this->ilias_global_template = $ilias_global_template;
    }


    public static function new(
        ilGlobalTemplateInterface $ilias_global_template
    ) : /*static*/ self
    {
        return new static(
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

        return str_replace("%CONTENT%", '<iframe style="border:none;height:calc(100vh - 220px);width:100%;" src="' . htmlspecialchars($url) . '"></iframe>', $html);
    }
}
