<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\User\UserDto;
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
    ) : /*static*/ self
    {
        return new static(
            $ilias_access
        );
    }


    public function hasAccessToFluxIliasRestObjectProxy(int $ref_id, ?UserDto $user) : bool
    {
        return $user !== null && $this->ilias_access->checkAccessOfUser($user->id, "read", "", $ref_id);
    }
}
