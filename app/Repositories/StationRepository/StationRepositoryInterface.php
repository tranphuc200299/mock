<?php

namespace App\Repositories\StationRepository;

use App\Repositories\RepositoryInterface;

interface StationRepositoryInterface extends RepositoryInterface
{
    public function getStationByCity($id, $with, $withCount);
}
