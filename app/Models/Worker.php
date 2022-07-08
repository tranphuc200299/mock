<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Worker extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function routeNotificationForVonage($notification)
    {
        return $this->phone;
    }

    public function jobFavorite(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Job', 'favorites', 'worker_id', 'job_id');
    }

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\WorkerProfile');
    }
}
