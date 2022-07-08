<?php

namespace App\Repositories\OccupationRepository;

use App\Models\Occupation;
use App\Models\OccupationImages;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OccupationRepository extends BaseRepository implements OccupationRepositoryInterface
{
    public function getModel(): string
    {
        return Occupation::class;
    }

    public function getAllOccupation()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function getOccupationById($id)
    {
        return $this->model->find($id);
    }

    public function getOccupationPaginate($limit)
    {
        $store = Auth::user()->store;
        return $this->model->where('store_id', $store[0]->id)->paginate($limit);
    }

    public function getOccupationByAjax($request, $limit)
    {
        //return Occupation::paginate($limit);
        $store = Auth::user()->store;
        return $this->model->where('store_id', $store[0]->id)->paginate($limit);
    }

    public function deleteOccupation($id)
    {
        return Occupation::where('id', $id)->delete();
    }

    public function addOccupation($data, $id = null)
    {
        $store = Auth::user()->store;
        return Occupation::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => (int)$data['category_id'],
            'work_address' => $data['work_address'],
            'access_address' => $data['work_address'],
            'speciality' => $data['speciality'],
            'note' => $data['note'],
            'bring_items' => $data['bring_item'],
            'skill_required' =>  isset($data['skill_required']) ? implode(",", $data['skill_required']) : '',
            'status' => $data['status'],
            'store_id' =>  $store[0]->id,
        ]);
    }

    public function editOccupation($data, $id)
    {
        $store = Auth::user()->store;
        $occupation = Occupation::find($id);
        $occupation->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => (int)$data['category_id'],
            'work_address' => $data['work_address'],
            'access_address' => $data['work_address'],
            'speciality' => $data['speciality'],
            'note' => $data['note'],
            'bring_items' => $data['bring_item'],
            'skill_required' =>  isset($data['skill_required']) ? implode(",", $data['skill_required']) : '',
            'status' => $data['status'],
            'store_id' =>  $store[0]->id,
        ]);
        return $occupation;
    }

    public function getAllOccupationByStore(){
        $store = Auth::user()->store;
        return $this->model->where('store_id', $store[0]->id)->get();
    }
}
