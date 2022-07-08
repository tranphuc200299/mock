<?php

namespace App\Repositories\CompanyRepository;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUserById($id);
    public function getAllUserByCompany($id);
}
