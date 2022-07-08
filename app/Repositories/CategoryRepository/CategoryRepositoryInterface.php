<?php

namespace App\Repositories\CategoryRepository;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getAllCategory();
    public function getAllCategoryPaginate($limit);
    public function getAllCategoryByAjax($request, $limit);
    public function getCategoryById($id);

    public function addCategory($request);
    public function updateCategory($request);
    public function getCategory($parentId);
    public function getCategoryByParent($parentId, $with, $withCount);
    public function getOccipationsByCategoryId($categoryId, $level);
}
