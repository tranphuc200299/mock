<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\JobRepository\JobRepositoryInterface;
use App\Repositories\StationRepository\StationRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
    protected $jobRepository;
    protected $categoryRepository;
    protected $stationRepository;
    public function __construct(JobRepositoryInterface $jobRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                StationRepositoryInterface $stationRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->categoryRepository = $categoryRepository;
        $this->stationRepository = $stationRepository;
    }

    public function index()
    {
        $allDays = [];
        for($i = 0;$i < 90 ; $i++){
            $day = [];
            $day['day'] = Carbon::now()->addDay($i)->day;
            $day['month'] = Carbon::now()->addDay($i)->month;
            $day['dayofweek'] = Carbon::now()->addDay($i)->dayOfWeek;
            $day['date'] = Carbon::now()->addDay($i)->toDateString();
            $allDays[$i]= $day;
        }
        return view('client.pages.home.home', compact('allDays'));
    }

    public function getDetailJob($id)
    {
        $job = $this->jobRepository->getJobWith($id);
        if(is_null($job)){
            abort(404);
        }

        $workerFavorite = null;
        if(Session::has('worker')) {
            $worker = Worker::find(Session::get('worker')->id);
            $workerFavorite = $worker->jobFavorite;
        }

        if(Session::get('history') != null) {
            $history = Session::get('history');
            foreach ($history as $key => $value) {
                if($value->id == $job->id) {
                    return view('client.pages.job.detail', compact('job', 'workerFavorite'));
                }
            }
        }

        Session::push('history', $job);
        return view('client.pages.job.detail', compact('job'));
    }

    public function multipleFilter(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $page = $request['page'];
        if (!$page) {
            $page = 1;
        }
        $perpage = 3;
        $limit = $page * $perpage;
        $offset = ($page - 1) * $perpage;

        // get id category by parent
        if(isset($data['category_parent']) || isset($data['category_child'])){
            $data['category_parent'] = $data['category_parent'] ?? [];
            $data['category_child'] = $data['category_child'] ?? [];
            $categoriesLv2 = Category::whereIn('parent_id',$data['category_parent'])->pluck('id')->toArray();
            $categoriesLv3 = Category::whereIn('parent_id',$categoriesLv2)->pluck('id')->toArray();
            $data['categories'] = array_merge($data['category_child'], $categoriesLv3);
        }

        // get id route by city
        if(isset($data['city_id']) || isset($data['route_id'])){
            $data['city_id'] = $data['city_id'] ?? [];
            $data['route_id'] = $data['route_id'] ?? [];
            $stationId = Station::whereIn('area_id',$data['city_id'])->pluck('id')->toArray();
            $routeId = Station::whereIn('parent_id',$stationId)->pluck('id')->toArray();
            $data['route'] = array_merge($data['route_id'], $routeId);
        }

        $total = $this->jobRepository->countJobsFilter($data);
        $jobs = $this->jobRepository->multipleFilterJob($data, $offset, $limit);

        $workerFavorite = null;
        if(Session::has('worker')) {
            $worker = Worker::find(Session::get('worker')->id);
            $workerFavorite = $worker->jobFavorite;
        }

        $hasNext = true;
        if ($limit >= $total->count()) {
            $hasNext = false;
        }
        return response()->json([
            'body' => view('client.pages.home.list-jobs', compact('jobs', 'workerFavorite'))->render(),
            'jobs' => $jobs,
            'hasNext' => $hasNext,
            'total' => $total->count(),
        ]);
    }
    public function getSubCategories(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['categories'] = $data['categories'] ?? [];
        if (in_array($data['id'], $data['categories'])) {
            $categoriesParent = $this->categoryRepository->getCategoryByParent([$data['id']], ['children.jobs']);
            $body = view('client.pages.home.child-categories',
                compact('categoriesParent'))->render();
        }else{
            $body = '';
        }
        return response()->json([
            'body' => $body,
        ]);
    }

    public function getStationRoute(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['city'] = $data['city'] ?? [];
        if (in_array($data['id'], $data['city'])) {
            $city = $this->stationRepository->getStationByCity($data['id'],['children']);
            $body = view('client.pages.home.list-station-route',
                compact('city'))->render();
        }else{
            $body = '';
        }
        return response()->json([
            'body' => $body,
        ]);
    }


}
