<?php

namespace App\Repositories\CategoryRepository;

use App\Components\Recusive;
use App\Models\Category;
use App\Repositories\BaseRepository;


class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel(): string
    {
        return Category::class;
    }

    public function getCategoryById($id)
    {

        return Category::find($id);
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getAllCategoryPaginate($limit)
    {
        return Category::paginate($limit);
    }

    public function getAllCategoryByAjax($request, $limit)
    {
        return Category::paginate($limit);
    }

    public function addCategory($request)
    {
        $category = $this->model->create([
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent_id']
        ]);

        return $category;
    }

    public function updateCategory($request)
    {
        $category = Category::where('id', $request['id'])->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent_id']
        ]);
        return $category;
    }

    public function getCategory($parentId, $occupation = null)
    {
        $data = $this->model->all();
        $recusive = new Recusive($data, $occupation);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function getCategoryByParent($parentId = [0], $with = [], $withCount = null)
    {
        $data = $this->model->whereIn('parent_id', $parentId)->with($with);
        if ($withCount){
            $data = $data->withCount($withCount);
        }

        return $data->get();
    }
    public function getOccipationsByCategoryId($categoryId, $level)
    {
        $check = $this->model->where('parent_id',$categoryId)->pluck('id')->toArray();
        if ($check) {
            $categories = $this->model->whereIn('id',$check)->get();
        }
        return $check;
    }
}

