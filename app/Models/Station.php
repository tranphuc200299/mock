<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $guarded = [];
    public const STATION = 1;
    public const ROUTE = 2;

    public function route() {
        return $this->where('level', Station::ROUTE)->get();
    }

    public function station() {
        return $this->where('level', Station::STATION)->get();
    }

    public function getStationByRoute($parent_id) {
        return $this->where('id', $parent_id)->first();
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Station', 'parent_id', 'id');
    }
}
