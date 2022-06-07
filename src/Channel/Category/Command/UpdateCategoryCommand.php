<?php

namespace FluxIliasApi\Channel\Category\Command;

use FluxIliasApi\Adapter\Category\CategoryDiffDto;
use FluxIliasApi\Adapter\Category\CategoryDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Channel\Category\CategoryQuery;
use FluxIliasApi\Channel\Category\Port\CategoryService;
use FluxIliasApi\Channel\CustomMetadata\CustomMetadataQuery;
use ilDBInterface;

class UpdateCategoryCommand
{

    use CategoryQuery;
    use CustomMetadataQuery;

    private CategoryService $category_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ CategoryService $category_service,
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->category_service = $category_service;
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        CategoryService $category_service,
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $category_service,
            $ilias_database
        );
    }


    public function updateCategoryById(int $id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category_service->getCategoryById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateCategoryByImportId(string $import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category_service->getCategoryByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateCategoryByRefId(int $ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category_service->getCategoryByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateCategory(?CategoryDto $category, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        if ($category === null) {
            return null;
        }

        $ilias_category = $this->getIliasCategory(
            $category->id,
            $category->ref_id
        );
        if ($ilias_category === null) {
            return null;
        }

        $this->mapCategoryDiff(
            $diff,
            $ilias_category
        );

        $ilias_category->update();

        return ObjectIdDto::new(
            $category->id,
            $diff->import_id ?? $category->import_id,
            $category->ref_id
        );
    }
}
