<?php

namespace App\Repositories\WorkerRepository;

use App\Repositories\RepositoryInterface;

interface WorkerRepositoryInterface extends RepositoryInterface
{
    public function getWorkers($limit, $with);
    public function getSearchWorkerByKey($request, $limit);
    public function deleteWorker($data);
}
