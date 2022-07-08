<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SkillsRequest;
use App\Models\Skills;
use Illuminate\Pagination\Paginator;
use App\Repositories\SkillRepository\SkillRepositoryInterface;

class SkillsController extends Controller
{

    protected $skillRepository;

    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function index()
    {
        $skills = $this->skillRepository->getAllSkillPaginate(5);
        return view("admin.skills.index")->with(compact('skills'));
    }
 
    public function pagination(Request $request)
    {

        if ($request->ajax()) {
            $skills = $this->skillRepository->getAllSkillByAjax($request, 5);
            return response()->json([
                'body' => view('admin.skills.pagination', compact('skills'))->render(),
                'skills' => $skills
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create
        return view("admin.skills.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillsRequest $request)
    {

        $skillStore = $this->skillRepository->addSkill($request);
        return redirect()->route('skill.index')->with('message', 'Add Success Skill');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editSkills = $this->skillRepository->getSkillById($id);

        return view('admin.skills.edit')->with(compact('editSkills'));
    } 
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillsRequest $request, $id)
    {
        $updateSkills = $this->skillRepository->updateSkill($request);
        return redirect()->route('skill.index')->with('message', 'Update Success Skill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
