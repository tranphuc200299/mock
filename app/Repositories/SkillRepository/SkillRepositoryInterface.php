<?php

namespace App\Repositories\SkillRepository;

use App\Repositories\RepositoryInterface;

interface SkillRepositoryInterface extends RepositoryInterface
{
    public function getAllSkill();
    public function getAllSkillPaginate($limit);
    public function getAllSkillByAjax($request, $limit);
  
    public function getSkillById($id);
    public function addSkill($request); 
    public function updateSkill($request);
}
