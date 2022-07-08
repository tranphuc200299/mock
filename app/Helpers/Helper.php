<?php
use App\Repositories\MediaRepository\MediaRepositoryInterface;
use App\Models\Company;
use App\Models\Occupation;
use App\Models\WorkerProfile;
use App\Repositories\OccupationRepository\OccupationRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\JobRepository\JobRepositoryInterface;

if (!function_exists('get_file_uploaded_company_by_id')) {
    function get_file_uploaded_company_by_id($id)
    {
        return app(MediaRepositoryInterface::class)->getFileUploadedById($id,Company::class, Company::MODEL_TYPE);
    }
}

if (!function_exists('get_occupation_by_store')) {
    function get_occupation_by_store()
    {
        return app(OccupationRepositoryInterface::class)->getAllOccupationByStore();
    }
}
if (!function_exists('decimal_hours')) {
    function decimal_hours($time): float
    {
        $hms = explode(":", $time);
        return round(($hms[0] + ($hms[1]/60)), 2);
    }
}

if (!function_exists('get_image_occupation_by_id')) {
    function get_image_occupation_by_id($id)
    {
        return app(MediaRepositoryInterface::class)->getFileUploadedById($id,Occupation::class, Occupation::MODEL_TYPE);
    }
}

if (!function_exists('get_image_degree_by_id')) {
    function get_image_degree_by_id($id)
    {
        return app(MediaRepositoryInterface::class)->getFileUploadedById($id,WorkerProfile::class, WorkerProfile::MODEL_TYPE);
    }
}

if (!function_exists('get_list_time_15_min')) {
    function get_list_time_15_min(): array
    {
        $date = '2022-12-1 00:00';
        $array = array();
        for($i =0; $i<=95; $i++){
            $tempTime = $i*15;
            $t = date('H:i',strtotime("+$tempTime minutes", strtotime($date)));
            $array[] = $t;
        }
        return $array;
    }
}
if (!function_exists('get_categories_by_parent')) {
    function get_categories_by_parent($parentId = [0], $with = [], $withCount = null)
    {
        return app(CategoryRepositoryInterface::class)->getCategoryByParent($parentId, $with, $withCount);
    }
}

if (!function_exists('count_jobs_by_category')) {
    function count_jobs_by_category($categoryId, $level)
    {
        return app(JobRepositoryInterface::class)->countJobsByCategoryId($categoryId, $level);
    }
}

if (!function_exists('count_jobs_by_station')) {
    function count_jobs_by_station($stationId, $level)
    {
        return app(JobRepositoryInterface::class)->countJobsByStationId($stationId, $level);
    }
}


