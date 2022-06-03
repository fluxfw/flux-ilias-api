<?php

namespace FluxIliasApi\Channel\File\Command;

use FluxIliasApi\Adapter\File\FileDto;
use FluxIliasApi\Channel\File\FileQuery;
use FluxIliasApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetFilesCommand
{

    use FileQuery;
    use ObjectQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return FileDto[]
     */
    public function getFiles(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapFileDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getFileQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
