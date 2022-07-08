<?php

namespace App\Repositories\WorkerRepository;
use App\Models\Worker;
use App\Models\WorkerProfile;
use App\Repositories\BaseRepository;

class WorkerRepository extends BaseRepository implements WorkerRepositoryInterface
{

    public function getModel(): string
    {
        return Worker::class;
    }

    public function getWorkers($limit, $with = [])
    {
        return $this->model->with($with)->paginate($limit);
    }

    public function getSearchWorkerByKey($request, $limit)
    {
        $data = $this->model;
        if($request['keyword'] != ''){
            $data = $data->whereHas('profile', function ($query) use ($request, $limit) {
                $query->where(\DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request['keyword']."%");
                $query->orWhere('email', 'LIKE', "%".$request['keyword']."%");
                $query->orWhere('phone', 'LIKE', "%".$request['keyword']."%");
                $query->orWhere('invitation_code', 'LIKE', "%".$request['keyword']."%");
            });
        }
        if($request['status']) {
            $data = $data->whereIn('verify_email', $request['status']);
        }
        if($request['date_start']) {
            $data = $data->where('created_at','>=',$request['date_start']);
        }
        if($request['date_end']) {
            $data = $data->where('created_at','<=',$request['date_end']);
        }

        return $data->with('profile')->paginate($limit);
    }

    public function deleteWorker($data) {
        WorkerProfile::where('worker_id', $data['id'])->delete();
        return $this->model->where('id', $data['id'])->delete();
    }
}
