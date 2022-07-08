<?php

namespace App\Repositories\CompanyRepository;

use App\Models\Company;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function getModel(): string
    {
        return Company::class;
    }

    public function getAllCompany()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function getCompanyById($id) {
        return $this->model->find($id);
    }

    public function getSearchCompanyByKey($request, $limit)
    {
        $company = $this->model;
        if($request->keyword != ''){
            $company = $company->where('company_name','LIKE','%'.$request->keyword.'%')
                ->orWhere('hp_url','LIKE','%'.$request->keyword.'%')
                ->orWhere('contact_name','LIKE','%'.$request->keyword.'%')
                ->orWhere('phone','LIKE','%'.$request->keyword.'%')
                ->orWhere('email','LIKE','%'.$request->keyword.'%')
                ->orWhere('city','LIKE','%'.$request->keyword.'%')
                ->orWhere('district','LIKE','%'.$request->keyword.'%');
        }
        return $company->paginate($limit);
    }

    public function getOneCompanyUser($id)
    {
        return User::find($id)->userCompany();
    }

    public function getAllCompanyUser()
    {
        return $this->model->get()->userCompany();
    }

    public function addCompanyUser($data) {
       $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
        ]);

        $user->assignRole('company');

        return $user;
    }

    public function getCompanyPagination($limit)
    {
        return $this->model->paginate($limit);
    }

    public function addEditCompany($data, $id = null)
    {
        return $this->model->updateOrCreate(
            ['id' => $id],
            [
                'company_name' => $data['companyName'],
                'company_name_kana' => $data['companyKanaName'],
                'register_name' => $data['registerName'],
                'register_name_kana' => $data['registerKanaName'],
                'city' => $data['city'],
                'district' => $data['district'],
                'room' => $data['room'],
                'building' => $data['building'],
                'zip_code' => $data['zipCode'],
                'hp_url' => $data['hpUrl'],
                'email' => $data['email'],
                'area_intends_to_recuit' => implode("|", $data['area']),
                'note' => $data['companyName'],
                'status' => $data['status'],
                'contact_name' => $data['contactName'],
                'phone' => $data['phoneNumber'],
                'career' => implode("|", $data['career']),
                'other' => $data['other'],
            ]);
    }
    public function updateCompanyUser($data) {
        if ($data['password']){
            User::where('id',$data['id'])->update([
                'password' => Hash::make($data['password']),
            ]);
        }
        $user = User::where('id', $data['id'])->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ]);

        return $user;
    }

    public function deleteUserOfCompany($data) {
        return User::where('id', $data['id'])->delete();
    }

}
