<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\JobRepository\JobRepositoryInterface;
use App\Http\Requests\StoreJobRequest;

class JobController extends Controller
{
    protected $jobRepository;


    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }
    //
    public function index()
    {
        $jobs = $this->jobRepository->getByPagination(4);
        return view("admin.job.index")->with(compact('jobs'));
    }

    public function create(Request $request, $id = null)
    {
        $occupationId = $id;
        return view("admin.job.add",compact('occupationId'));
    }
    public function showJob(Request $request)
    {
        if ($request->ajax())
        {
            $jobs = $this->jobRepository->getSearchJobByKey($request, 4);
            return response()->json([
                'body' => view('admin.job.search-pagination', compact('jobs'))->render(),
                'jobs' => $jobs
            ]);
        }
    }

    public function confirmCreate(StoreJobRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $times = $data['time'];
        $errors = [];
        foreach ($times as $key => $item){
            $workingTimeTo = new Carbon($item['workingTimeTo'] );
            $workingTimeFrom = new Carbon($item['workingTimeFrom'] );
            if ($workingTimeTo < $workingTimeFrom){
                $errors["time-$key-workingTimeTo"] = 'End time must be greater than start time';
            }
        }
        if(!empty($errors)){
            return response()->json([
                'errors' => $errors,
                'status' => 400,
            ]);
        }
        $occupation = Occupation::find($data['occupation']);

        return response()->json([
            'job' => $data,
            'occupation' => $occupation,
            'images' => get_image_occupation_by_id($occupation->id)
        ]);
    }
    public function getDetail(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $job = $this->jobRepository->getJobWith($data['id']);
        return response()->json([
            'job' => $job,
            'images' => get_image_occupation_by_id($job->occupation->id)
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $job = $this->jobRepository->createJob($data);
        return response()->json([
            'job' => $job
        ]);
    }

    public function edit(Request $request, $id)
    {
        $job = $this->jobRepository->find($id);
        if(is_null($job)){
            abort(404);
        }
        return view('admin.job.edit', compact('job'));
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $job = $this->jobRepository->updateJob($data);
        return response()->json([
            'job' => $job,
        ]);
    }

    public function duplicate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $job = $this->jobRepository->duplicateJob($data['id']);
        if(is_null($job)){
            abort(404);
        }
        return redirect()->route('job.edit', [$job->id]);
    }

}
