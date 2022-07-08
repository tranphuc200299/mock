<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Worker;
use App\Models\WorkerProfile;
use App\Repositories\WorkerRepository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    protected $workerRepository;

    public function __construct(WorkerRepositoryInterface $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }
    public function index() {
        $workers =  $this->workerRepository->getWorkers(3,['profile']);
        return view("admin.worker.index", compact('workers'));
    }

    public function showWorkers(Request $request)
    {
        if ($request->ajax())
        {
            $workers = $this->workerRepository->getSearchWorkerByKey($request, 3);
            return response()->json([
                'body' => view('admin.worker.search-and-pagination', compact('workers'))->render(),
                'workers' => $workers,
            ]);
        }
    }

    public function deleteWorker(Request $request)
    {
        $data = $request->all();
        if ($request->ajax())
        {
            try {
                $workers = $this->workerRepository->deleteWorker($data);
                return response()->json([
                    'message' => 'Delete Worker Success',
                    'workers' => $workers,
                    'status' => 200
                ]);
            } catch (Throwable $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => 400
                ]);
            }
        }
    }

    public function edit($id, Area $area) {
       $worker = Worker::find($id);
       $profile = $worker->profile;
       $areas = $area->area();
       return view('admin.worker/edit-worker', compact('worker', 'profile', 'areas'));
    }

    public function update($id, Request $request) {
        $worker = Worker::find($id);
        $worker->update([
            'verify_email' => $request->verify_email,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $worker->profile->update([
            'gender' => $request->gender,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'furigana_first_name' => $request->furigana_first_name,
            'furigana_last_name' => $request->furigana_last_name,
            'birthday' => $request->birthday,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.worker.index');
    }

    public function show($id) {
        $worker = Worker::find($id);
        $profile = $worker->profile;
        return response()->json([
            'worker' => $worker,
            'profile' => $profile,
            'images' => get_image_degree_by_id($profile->id),
        ]);
    }

    public function approveProfile($id, Request $request) {
        WorkerProfile::where('worker_id', $id)->update([
            'status' => $request->status,
        ]);
    }

    public function rejectProfile($id) {
        WorkerProfile::where('worker_id', $id)->update([
            'passport_image_front' => null,
            'passport_image_back' => null,
            'status' => 3,
        ]);
    }
}
