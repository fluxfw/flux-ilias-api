<?php

namespace FluxIliasApi\Service\ScormLearningModule\Command;

use FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasApi\Service\Object\ObjectQuery;
use FluxIliasApi\Service\ScormLearningModule\ScormLearningModuleQuery;
use ilDBInterface;

class GetScormLearningModulesCommand
{

    use ObjectQuery;
    use ScormLearningModuleQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return ScormLearningModuleDto[]
     */
    public function getScormLearningModules(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapScormLearningModuleDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getScormLearningModuleQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
