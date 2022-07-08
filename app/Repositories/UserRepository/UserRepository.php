<?php

namespace App\Repositories\CompanyRepository;

use App\Models\Company;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel(): string
    {
        return User::class;
    }
    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getAllUserByCompany($id)
    {
        return Company::find($id)->userCompany();
    }
}
