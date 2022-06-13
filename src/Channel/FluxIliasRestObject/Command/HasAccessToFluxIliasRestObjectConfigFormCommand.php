<?php

namespace FluxIliasApi\Channel\FluxIliasRestObject\Command;

use FluxIliasApi\Adapter\User\UserDto;
use ilAccessHandler;

class HasAccessToFluxIliasRestObjectConfigFormCommand
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


    public function hasAccessToFluxIliasRestObjectConfigForm(int $ref_id, ?UserDto $user) : bool
    {
        return $user !== null && $this->ilias_access->checkAccessOfUser($user->id, "write", "", $ref_id);
    }
}
