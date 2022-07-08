<?php

namespace App\Repositories\StoreRepository;

use App\Repositories\RepositoryInterface;

interface StoreRepositoryInterface extends RepositoryInterface
{
    public function getStoreById($id);
    public function getAllStoreUser();
    public function addEditStoreUser($data);
    public function getSearchStoreByKey($request, $limit);
    public function getStorePagination($limit);
    public function addEditStore($data, $id = null);
    public function deleteUserOfStore($data);
}
