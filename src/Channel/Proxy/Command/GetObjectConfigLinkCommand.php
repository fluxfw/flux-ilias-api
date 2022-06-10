<?php

namespace FluxIliasApi\Channel\Proxy\Command;

class GetObjectConfigLinkCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function getObjectConfigLink(int $ref_id) : string
    {
        return "flux-ilias-rest-object-config/" . $ref_id;
    }
}
