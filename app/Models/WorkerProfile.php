<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    use HasFactory;
    protected $table = "worker_profile";
    protected $guarded = [];

    const MODEL_TYPE = 'profile_file';

    const STATUS = [
        'NOT-SETTING-PROFILE' => 3,
        'DEACTIVED' => 1,
        'PENDING-APPROVE' => 2,
        'ACTIVED' => 0,
    ];

    const GENDER =
    [
        'MALE'   => 1,
        'FEMALE' => 2
    ];

    public static function getStatus($key): string
    {
        switch ($key){
            case 0:
                return 'Actived';
            case 1:
                return 'Deactived';
            case 2:
                return 'Pending approve';
            case 3:
                return 'Not setting profile';
            default:
                return 'Not found';
        }

    }
}
