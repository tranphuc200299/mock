<?php

namespace App\Repositories\OccupationRepository;

use App\Repositories\RepositoryInterface;

interface OccupationRepositoryInterface extends RepositoryInterface
{
    public function getOccupationById($id);
    public function getAllOccupation();
    public function addOccupation($data, $id = null);
    public function getOccupationPaginate($limit);
    public function getOccupationByAjax($request, $limit);
    public function deleteOccupation($id);
    public function getAllOccupationByStore();
}
