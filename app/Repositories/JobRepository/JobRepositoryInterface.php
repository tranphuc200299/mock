<?php

namespace App\Repositories\JobRepository;

use App\Repositories\RepositoryInterface;

interface JobRepositoryInterface extends RepositoryInterface
{
    public function getByPagination($limit);
    public function getSearchJobByKey($request, $limit);
    public function getJobWith($id);
    public function createJob($request);
    public function updateJob($request);
    public function duplicateJob($id);
    public function multipleFilterJob($request, $offset, $limit);
    public function countJobsFilter($request);
    public function countJobsByCategoryId($categoryId, $level);
    public function countJobsByStationId($stationId, $level);
}
