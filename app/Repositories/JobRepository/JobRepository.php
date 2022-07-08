<?php

namespace App\Repositories\JobRepository;

use App\Models\Area;
use App\Models\Category;
use App\Models\Station;
use App\Repositories\BaseRepository;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function getModel(): string
    {
        return Job::class;
    }

    public function getByPagination($limit)
    {
        return $this->model->where('store_id',Auth::user()->store[0]->id)->paginate($limit);
    }
    public function getSearchJobByKey($request, $limit)
    {
        $data = $this->model->where('store_id',Auth::user()->store[0]->id);
        if($request->keyword != ''){
            $data = $data->whereHas('occupation', function ($query) use ($request, $limit) {
                $query->where('title', 'LIKE', '%'.$request->keyword.'%');
            });
        }
        if(isset($request->status)){
            $data = $data->whereIn('status',$request->status);
        }
        return $data->paginate($limit);
    }

    public function getJobWith($id)
    {
        return $this->model
            ->where('id', $id)
            ->with(['occupation.category'])->first();
    }

    public function createJob($request)
    {
        $job = null;
        foreach($request['time'] as $time) {
            $totalAmount = decimal_hours($time['workTime']);
            $job = $this->model->create([
                'store_id' => Auth::user()->store[0]->id,
                'occupation_id' => $request['occupation'],
                'break_time' => $request['breakTime'],
                'required_number_of_person' => $request['numberOfPeople'],
                'salary_per_hour' => $request['salaryPerHour'],
                'travel_fees' => $request['travelFees'],
                'status' => $request['status'],
                'setting_matching_job' => $request['settingJob'],
                'deadline_for_apply' => date('Y-m-d H:i:s', strtotime($time['deadlineDate'].' '.$time['deadlineTime'])),
                'deadline_time_apply' => $time['deadlineTime'],
                'work_date' => $time['workDate'],
                'work_time' => $time['workTime'],
                'work_time_from' => $time['workingTimeFrom'],
                'work_time_to' => $time['workingTimeTo'],
                'total_amount' => $totalAmount* $request['salaryPerHour'] +$request['travelFees'] ,
            ]);
        }
        return $job;
    }

    public function updateJob($request)
    {
        $job = $this->model->find($request['id']);
        if (!is_null($job)){
            $time = $request['time'];
            $totalAmount = decimal_hours($time[0]['workTime']);
            $job->update([
                'occupation_id' => $request['occupation'],
                'break_time' => $request['breakTime'],
                'required_number_of_person' => $request['numberOfPeople'],
                'salary_per_hour' => $request['salaryPerHour'],
                'travel_fees' => $request['travelFees'],
                'status' => $request['status'],
                'setting_matching_job' => $request['settingJob'],
                'deadline_for_apply' => date('Y-m-d H:i:s', strtotime($time[0]['deadlineDate'].' '.$time[0]['deadlineTime'])),
                'deadline_time_apply' => $time[0]['deadlineTime'],
                'work_date' => $time[0]['workDate'],
                'work_time' => $time[0]['workTime'],
                'work_time_from' => $time[0]['workingTimeFrom'],
                'work_time_to' => $time[0]['workingTimeTo'],
                'total_amount' => $totalAmount* $request['salaryPerHour'] +$request['travelFees'],
            ]);
        }
        return $job;
    }
    public function duplicateJob($id)
    {
        $job = $this->model->find($id);
        $newJob = $job->replicate();
        $newJob->save();
        return $newJob;
    }

    public function multipleFilterJob($request, $offset, $limit)
    {
        $data = $this->model->where('status', $this->model::STATUS['HIRING']);
        $request['filterDate'] = $request['filterDate'] ?? [];
        if($request['filterDate']){
            $data = $data->whereIn('work_date',$request['filterDate']);
        }
        if(isset($request['categories'])){
            $data = $data->whereHas('occupation', function($q) use ($request){
                $q->whereIn('category_id', $request['categories']);
            });
        }
        if(isset($request['route'])){
            $data = $data->whereHas('occupation.OccupationStation', function($q) use ($request){
                $q->whereIn('station_id', $request['route']);
            });
        }
        $request['order'] = $request['order'] ?? 'work_date';
        if($request['order'] == 'work_date'){
            $data = $data->orderBy($request['order'], 'ASC');
        }elseif($request['order'] == 'created_at'){
            $data = $data->orderBy($request['order'], 'DESC');
        }else{
            $data = $data->orderBy('total_amount', 'DESC');
        }

        return $data->with(['occupation.category','occupation.OccupationStation'])->limit($limit)->get();
    }
    public function countJobsFilter($request)
    {
        $data = $this->model->where('status', $this->model::STATUS['HIRING']);
        $request['filterDate'] = $request['filterDate'] ?? [];
        if($request['filterDate']){
            $data = $data->whereIn('work_date',$request['filterDate']);
        }
        if(isset($request['categories'])){
            $data = $data->whereHas('occupation', function($q) use ($request){
                $q->whereIn('category_id', $request['categories']);
            });
        }
        if(isset($request['route'])){
            $data = $data->whereHas('occupation.OccupationStation', function($q) use ($request){
                $q->whereIn('station_id', $request['route']);
            });
        }
        $request['order'] = $request['order'] ?? 'work_date';
        if($request['order'] == 'work_date'){
            $data = $data->orderBy($request['order'], 'ASC');
        }elseif($request['order'] == 'created_at'){
            $data = $data->orderBy($request['order'], 'DESC');
        }else{
            $data = $data->orderBy('total_amount', 'DESC');
        }
        return $data->get();
    }

    public function countJobsByCategoryId($categoryId, $level)
    {
        if($level == 1){
            $categoriesLv2 = Category::where('parent_id',$categoryId)->pluck('id')->toArray();
            $categoriesLv3 = Category::whereIn('parent_id',$categoriesLv2)->pluck('id')->toArray();
            $data = $this->model->whereHas('occupation', function($q) use ($categoriesLv3){
                $q->whereIn('category_id',$categoriesLv3);
            });
        }else if($level == 2){
            $check = Category::where('parent_id',$categoryId)->pluck('id')->toArray();
            $data = $this->model->whereHas('occupation', function($q) use ($check){
                $q->whereIn('category_id',$check);
            });
        }else{
            $data = $this->model->whereHas('occupation', function($q) use ($categoryId){
                $q->where('category_id',$categoryId);
            });
        }
        $data = $data->where('status', $this->model::STATUS['HIRING']);
//        dd($data->get());
        return $data->get()->count();
    }

    public function countJobsByStationId($stationId, $level)
    {
        if($level == 1){
            // get array id city by area id
            $arrCityId = Area::where('parent_id',$stationId)->pluck('id')->toArray();
            // get id station by City id
            $arrStationId = Station::whereIn('area_id',$arrCityId)->pluck('id')->toArray();
            // get route child id
            $arrRouteId = Station::whereIn('parent_id',$arrStationId)->pluck('id')->toArray();

            $data = $this->model->whereHas('occupation.OccupationStation', function($q) use ($arrRouteId){
                $q->whereIn('station_id',$arrRouteId);
            });
        }else if($level == 2){
            // get id station by City id
            $arrStationId = Station::where('area_id',$stationId)->pluck('id')->toArray();
            // get route child id
            $arrRouteId = Station::whereIn('parent_id',$arrStationId)->pluck('id')->toArray();

            $data = $this->model->whereHas('occupation.OccupationStation', function($q) use ($arrRouteId){
                $q->whereIn('station_id',$arrRouteId);
            });
        }else{
            $data = $this->model->whereHas('occupation.OccupationStation', function($q) use ($stationId){
                $q->where('station_id',$stationId);
            });
        }

        $data = $data->where('status', $this->model::STATUS['HIRING']);
//        dd($data->get());
        return $data->get()->count();
    }
}
