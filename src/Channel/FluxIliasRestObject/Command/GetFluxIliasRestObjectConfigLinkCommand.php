<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

class GetFluxIliasRestObjectConfigLinkCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function getFluxIliasRestObjectConfigLink(int $ref_id) : string
    {
        return "flux-ilias-rest-object-config/" . $ref_id;
    }
}
