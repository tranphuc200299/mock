<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const AREA = 0;
    public const CITY = 1;
    public const DISTRICT = 2;

    public function city() {
        return $this->where('level', Area::CITY)->get();
    }

    public function area() {
        return $this->where('level', Area::AREA)->get();
    }

    public function district($id) {
        return $this->where([['parent_id',$id],['level',Area::DISTRICT]])->get();
    }
}
