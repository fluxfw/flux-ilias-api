<?php

namespace FluxIliasApi\Channel\ObjectConfigForm\Command;

use FluxIliasApi\Adapter\Object\LegacyDefaultObjectType;
use FluxIliasApi\Adapter\Object\ObjectDto;
use FluxIliasApi\Adapter\User\UserDto;
use ilAccessHandler;

class HasAccessToObjectConfigFormCommand
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


    public function hasAccessToObjectConfigForm(?ObjectDto $object, ?UserDto $user) : bool
    {
        return $object !== null && $user !== null && $object->type->value === LegacyDefaultObjectType::FLUX_ILIAS_REST_OBJECT_HELPER_PLUGIN()->value
            && $this->ilias_access->checkAccessOfUser($user->id, "write", "", $object->ref_id);
    }
}
