<?php

namespace App\Repositories\StationRepository ;

use App\Models\Station;
use App\Repositories\BaseRepository;

class StationRepository extends BaseRepository  implements StationRepositoryInterface
{

    public function getModel(): string
    {
        return Station::class;
    }

    public function getStationByCity($id, $with = [], $withCount = null)
    {
        $data = $this->model->where('area_id', $id)->with($with);
        if ($withCount){
            $data = $data->withCount($withCount);
        }
        return $data->get();
    }
}
