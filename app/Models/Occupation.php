<?php

namespace App\Models;

use App\Models\OccupationImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Media;

class Occupation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'occupations';
    protected $guarded = [];

    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Job');
    }

    public function OccupationStation() {
        return $this->belongsToMany('App\Models\Station', 'occupation_station', 'occupation_id', 'station_id');
    }
    public function images(){
        return $this->hasMany(OccupationImages::class,'occupation_id');
    }
    public function medias()
    {
        return $this->morphMany(Media::class, 'modelable');
    }
    public function OccupationMedia(){
        return $this->hasMany(Media::class,'occupation_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }


    const MODEL_TYPE = 'occupation_file';
}
