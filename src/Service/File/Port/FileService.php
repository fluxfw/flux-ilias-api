<?php

namespace FluxIliasApi\Service\File\Port;

use FluxIliasApi\Adapter\File\FileDiffDto;
use FluxIliasApi\Adapter\File\FileDto;
use FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasApi\Service\File\Command\CreateFileCommand;
use FluxIliasApi\Service\File\Command\GetFileCommand;
use FluxIliasApi\Service\File\Command\GetFilesCommand;
use FluxIliasApi\Service\File\Command\UpdateFileCommand;
use FluxIliasApi\Service\File\Command\UploadFileCommand;
use FluxIliasApi\Service\Object\Port\ObjectService;
use ilDBInterface;
use ILIAS\FileUpload\FileUpload;

class FileService
{

    private ilDBInterface $ilias_database;
    private FileUpload $ilias_upload;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ FileUpload $ilias_upload,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->ilias_upload = $ilias_upload;
        $this->object_service = $object_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        FileUpload $ilias_upload,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $ilias_upload,
            $object_service
        );
    }


    public function createFileToId(int $parent_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object_service
        )
            ->createFileToId(
                $parent_id,
                $diff
            );
    }


    public function createFileToImportId(string $parent_import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object_service
        )
            ->createFileToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createFileToRefId(int $parent_ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object_service
        )
            ->createFileToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getFileById(int $id, ?bool $in_trash = null) : ?FileDto
    {
        return GetFileCommand::new(
            $this->ilias_database
        )
            ->getFileById(
                $id,
                $in_trash
            );
    }


    public function getFileByImportId(string $import_id, ?bool $in_trash = null) : ?FileDto
    {
        return GetFileCommand::new(
            $this->ilias_database
        )
            ->getFileByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getFileByRefId(int $ref_id, ?bool $in_trash = null) : ?FileDto
    {
        return GetFileCommand::new(
            $this->ilias_database
        )
            ->getFileByRefId(
                $ref_id,
                $in_trash
            );
    }


    /**
     * @return FileDto[]
     */
    public function getFiles(?bool $in_trash = null) : array
    {
        return GetFilesCommand::new(
            $this->ilias_database
        )
            ->getFiles(
                $in_trash
            );
    }


    public function updateFileById(int $id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileById(
                $id,
                $diff
            );
    }


    public function updateFileByImportId(string $import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileByImportId(
                $import_id,
                $diff
            );
    }


    public function updateFileByRefId(int $ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileByRefId(
                $ref_id,
                $diff
            );
    }


    public function uploadFileById(int $id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->ilias_upload
        )
            ->uploadFileById(
                $id,
                $title,
                $replace
            );
    }


    public function uploadFileByImportId(string $import_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->ilias_upload
        )
            ->uploadFileByImportId(
                $import_id,
                $title,
                $replace
            );
    }


    public function uploadFileByRefId(int $ref_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->ilias_upload
        )
            ->uploadFileByRefId(
                $ref_id,
                $title,
                $replace
            );
    }
}
