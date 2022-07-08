<?php

namespace App\Repositories\CompanyRepository;

use App\Repositories\RepositoryInterface;

interface CompanyRepositoryInterface extends RepositoryInterface
{
    public function getCompanyById($id);
    public function getAllCompany();
    public function getOneCompanyUser($id);
    public function getAllCompanyUser();
    public function addCompanyUser($data);
    public function getSearchCompanyByKey($request, $limit);
    public function getCompanyPagination($limit);
    public function addEditCompany($data, $id = null);
    public function updateCompanyUser($data);
    public function deleteUserOfCompany($data);
}
