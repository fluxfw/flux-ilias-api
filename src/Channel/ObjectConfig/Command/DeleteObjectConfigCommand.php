<?php

namespace FluxIliasApi\Channel\ObjectConfig\Command;

use FluxIliasApi\Channel\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class DeleteObjectConfigCommand
{

    use ObjectConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function deleteObjectConfig(int $id) : void
    {
        ilContainer::_deleteContainerSettings($id);
    }
}
