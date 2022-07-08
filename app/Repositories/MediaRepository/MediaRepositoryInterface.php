<?php

namespace App\Repositories\MediaRepository;

use App\Repositories\RepositoryInterface;

interface MediaRepositoryInterface extends RepositoryInterface
{
    public function getMediaPagination($limit);
    public function saveFileUploadCompany($request);
    public function getFileUploadedById($id, $modelbleType, $modelType);
}
