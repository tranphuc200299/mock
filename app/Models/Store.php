<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userStore() {
        return $this->belongsToMany('App\Models\User', 'user_store', 'store_id', 'user_id');
    }

    public function storeStation() {
        return $this->belongsToMany('App\Models\Station', 'store_station', 'store_id', 'station_id');
    }
}
