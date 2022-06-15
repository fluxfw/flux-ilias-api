<?php

namespace FluxIliasApi\Adapter\ObjectLearningProgress;

class ObjectLearningProgressDto
{

    public ?LegacyObjectLearningProgress $learning_progress;
    public ?int $object_id;
    public ?string $object_import_id;
    public ?int $object_ref_id;
    public ?int $user_id;
    public ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $object_id,
        /*public readonly*/ ?string $object_import_id,
        /*public readonly*/ ?int $object_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress
    ) {
        $this->object_id = $object_id;
        $this->object_import_id = $object_import_id;
        $this->object_ref_id = $object_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->learning_progress = $learning_progress;
    }


    public static function new(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?LegacyObjectLearningProgress $learning_progress = null
    ) : static {
        return new static(
            $object_id,
            $object_import_id,
            $object_ref_id,
            $user_id,
            $user_import_id,
            $learning_progress
        );
    }
}
