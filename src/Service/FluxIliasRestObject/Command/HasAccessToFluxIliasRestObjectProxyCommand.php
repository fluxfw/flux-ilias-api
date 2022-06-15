<?php

namespace FluxIliasApi\Service\FluxIliasRestObject\Command;

use ilAccessHandler;

class HasAccessToFluxIliasRestObjectProxyCommand
{

    private ilAccessHandler $ilias_access;


    private function __construct(
        /*private readonly*/ ilAccessHandler $ilias_access
    ) {
        $this->ilias_access = $ilias_access;
    }


    public static function new(
        ilAccessHandler $ilias_access
    ) : static {
        return new static(
            $ilias_access
        );
    }


    public function hasAccessToFluxIliasRestObjectProxy(int $ref_id, int $user_id) : bool
    {
        return $this->ilias_access->checkAccessOfUser($user_id, "read", "", $ref_id);
    }
}
