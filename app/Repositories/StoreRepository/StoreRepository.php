<?php

namespace App\Repositories\StoreRepository;

use App\Models\Store;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    public function getModel(): string
    {
        return Store::class;
    }

    public function getStorePagination($limit)
    {
        $company = Auth::user()->company;
        return $this->model->where('company_id', $company[0]->id)->paginate($limit);
    }

    public function getStoreById($id) {
        return $this->model->find($id);
    }

    public function getSearchStoreByKey($request, $limit)
    {
        $store = $this->model->paginate($limit);
        if($request->keyword != ''){
            $store = $this->model->where('store_name','LIKE','%'.$request->keyword.'%')->paginate($limit);
        }
        return $store;
    }

    public function getAllStoreUser()
    {
        return $this->model->get()->userStore();
    }

    public function addEditStoreUser($data, $id = null) {
       $user = User::updateOrCreate(
           ['id' => $id],
           [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
        ]);

        return $user;
    }

    public function addEditStore($data, $id = null)
    {
        $company = Auth::user()->company;
        return $this->model->updateOrCreate(
            ['id' => $id],
            [
                'store_name' => $data['storeName'],
                'store_kana_name' => $data['storeKanaName'],
                'city' => $data['city'],
                'address' => $data['address'],
                'district' => $data['district'],
                'hp_url' => $data['hpUrl'],
                'person_in_charge_email' => $data['person_in_charge_email'],
                'person_in_charge_phone_number' => $data['person_in_charge_phone_number'],
                'person_in_charge_name' => $data['person_in_charge_name'],
                'status' => $data['status'],
                'company_id' =>  $company[0]->id,
            ]);
    }

    public function deleteUserOfStore($data) {
        return User::where('id', $data['id'])->delete();
    }

}
