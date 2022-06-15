<?php

namespace FluxIliasApi\Service\ObjectConfig\Command;

use FluxIliasApi\Service\ObjectConfig\ObjectConfigQuery;
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
