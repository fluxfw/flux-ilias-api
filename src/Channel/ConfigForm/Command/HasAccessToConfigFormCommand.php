<?php

namespace FluxIliasApi\Channel\ConfigForm\Command;

use FluxIliasApi\Adapter\User\UserDto;

class HasAccessToConfigFormCommand
{

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function hasAccessToConfigForm(?UserDto $user) : bool
    {
        return $user !== null && $user->id === intval(SYSTEM_USER_ID);
    }
}
