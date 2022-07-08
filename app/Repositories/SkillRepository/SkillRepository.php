<?php

namespace App\Repositories\SkillRepository ;

use App\Models\Skills;
use App\Repositories\BaseRepository;

// use Illuminate\Support\Facades\Hash; 

class SkillRepository extends BaseRepository  implements SkillRepositoryInterface
{
 
    public function getModel(): string
    {
        return Skills::class;
    }

    public function getSkillById($id){
 
        return Skills::find($id);
    }

    public function getAllSkill()
    {
        return Skills::all();
    }

    public function getAllSkillPaginate($limit) 
    {
        return Skills::paginate($limit);
    } 
    
    public function getAllSkillByAjax($request, $limit) 
    {
        return Skills::paginate($limit); 
    }
    
    public function addSkill($request) {
       $skill = $this->model->create([
            'name' => $request['name'],
            'description' => $request['description']
    
        ]);

        return $skill;
    }

    public function updateSkill($request) {

        $skillUpdate= $this->model->where('id',$request['id'])->update([
            'name' => $request['name'],
            'description' => $request['description']
            ]);
            return $skillUpdate;
        }

}
