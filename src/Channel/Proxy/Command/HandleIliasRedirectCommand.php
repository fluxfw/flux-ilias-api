<?php

namespace FluxIliasApi\Channel\Proxy\Command;

use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;

class HandleIliasRedirectCommand
{

    private RestApi $rest_api;


    private function __construct(
        /*private readonly*/ RestApi $rest_api
    ) {
        $this->rest_api = $rest_api;
    }


    public static function new(
        RestApi $rest_api
    ) : /*static*/ self
    {
        return new static(
            $rest_api
        );
    }


    public function handleIliasRedirect(string $url) : ?string
    {
        if (str_contains($url, "/Customizing/") || str_ends_with($url, "/Customizing")) {
            return null;
        }

        $request = $this->rest_api->getDefaultRequest(
            false
        );

        $target = $request->getQueryParam(
            "target"
        );
        switch (true) {
            case str_starts_with($target, "flilre_api_proxy_"):
            case str_starts_with($target, "flilre_web_proxy_"):
                $is_ilias_entrypoint = false;
                foreach (
                    [
                        "error.php",
                        "goto.php",
                        "ilias.php",
                        "login.php",
                        "logout.php"
                    ] as $ilias_entrypoint
                ) {
                    if (str_contains($url, "/" . $ilias_entrypoint . "?") || str_ends_with($url, "/" . $ilias_entrypoint)) {
                        $is_ilias_entrypoint = true;
                        break;
                    }
                }
                if (!$is_ilias_entrypoint) {
                    return null;
                }

                return substr($url, strpos($url, "/" . $ilias_entrypoint));

            default:
                return null;
        }
    }
}